<?php

class ProductModel extends Model
{
    private $_table_products = 'products';
    private $_table_product_type = 'product_type';

    // -- Lấy danh sách 10 sản phẩm có lượt bán cao nhất
    public function get_BestSellingProducts()
    {
        $sql = "WITH best_selling_products AS (
    
                SELECT p.product_id, 
                    p.name AS product_name, 
                    SUM(od.quantity) AS total_sold
                FROM order_details od
                JOIN product_type pt ON od.product_type_id = pt.product_type_id
                JOIN products p ON pt.product_id = p.product_id
                GROUP BY p.product_id
                ORDER BY total_sold DESC
                LIMIT 6
            ),
            best_selling_product_type AS (
                -- Lấy product_type có lượt bán cao nhất cho mỗi sản phẩm
                SELECT pt.product_id,
                    pt.product_type_id,
                    pt.image,
                    pt.priceCurrent AS price,
                    pt.priceOld AS price_old,
                    pt.discount_price,
                    SUM(od.quantity) AS total_sold_product_type,
                    RANK() OVER (
                        PARTITION BY pt.product_id 
                        ORDER BY SUM(od.quantity) DESC, pt.product_type_id ASC
                    ) AS rank_order
                FROM order_details od
                JOIN product_type pt ON od.product_type_id = pt.product_type_id
                GROUP BY pt.product_id, pt.product_type_id, pt.image, pt.priceCurrent, pt.priceOld, pt.discount_price
            )
            SELECT b.product_id, 
                b.product_name, 
                b.total_sold,
                bst.product_type_id,
                bst.image,
                bst.price,
                bst.price_old,
                bst.discount_price,
                bst.total_sold_product_type
            FROM best_selling_products b
            JOIN best_selling_product_type bst ON b.product_id = bst.product_id
            WHERE bst.rank_order = 1";


        $result = $this->fetchAll($sql);
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function stockQuantityOf_allProducts()
    {
        $sql = "SELECT product_type_id,stock_quantity FROM $this->_table_product_type";

        $result = $this->fetchAll($sql);
        return $result;
    }

    public function get_ProductsFlashSale()
    {
        $sql = "SELECT p.product_id, p.name AS product_name, pt.product_type_id, pt.image, pt.priceOld, pt.priceCurrent, pt.discount_price
            FROM products p
            JOIN product_type pt 
                ON p.product_id = pt.product_id
                AND pt.discount_price = (
                    SELECT MAX(pt2.discount_price) 
                    FROM product_type pt2 
                    WHERE pt2.product_id = p.product_id
                )
                AND pt.product_type_id = (
                    SELECT MIN(pt3.product_type_id) 
                    FROM product_type pt3 
                    WHERE pt3.product_id = p.product_id
                    AND pt3.discount_price = (
                        SELECT MAX(pt4.discount_price) 
                        FROM product_type pt4 
                        WHERE pt4.product_id = p.product_id
                    )
                )
            ORDER BY pt.discount_price DESC
            LIMIT 5";


        $result = $this->fetchAll($sql);
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function get_product($id_product)
    {
        $sql = "SELECT p.product_id, p.name as product_name, p.description, b.name as brand_name 
            FROM products p
            join brands b on p.brand_id = b.brand_id
            WHERE product_id = ?";
        $params = [$id_product];
        $result = $this->fetch($sql, $params);
        if (!$result) {
            return false;
        }
        return $result;
    }


    public function getAll_productType_ofProduct($id_product)
    {
        $sql = "SELECT * FROM product_type WHERE product_id = ?";
        $params = [$id_product];
        $result = $this->fetchAll($sql, $params);
        if (!$result) {
            return false;
        }
        return $result;
    }

    // Loại sản phẩm sẽ được chọn mặc định khi nhấn vào sản phẩm đó
    //  chẳng hạn như product_type có discount_price lớn nhất sẽ được chọn là món hàng mặc định khi bấm vào
    public function getDefault_product_type($id_product_type)
    {
        $sql = "SELECT * FROM product_type WHERE product_type_id = ?";
        $params = [$id_product_type];
        $result = $this->fetch($sql, $params);
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function getAll_imageOfProduct($id_product)
    {

        $sql = "SELECT pi.image_url
            FROM product_images pi
            JOIN products p ON pi.product_id = p.product_id
            WHERE p.product_id = ?";
        $params = [$id_product];
        $result = $this->fetchAll($sql, $params);
        if (!$result) {
            return false;
        }
        return $result;
    }

    // Lấy thể loại sản phẩm để làm danh mục
    public function getCategories()
    {
        $sql = "SELECT category_id,name FROM van_phong_pham.categories
            limit 5";
        $result = $this->fetchAll($sql);
        if (!$result) {
            return false;
        }
        return $result;
    }

    // Kiểm tra loại sản phẩm đó có tồn tại không
    public function checkCategoryExists($category_id)
    {
        $sql = "SELECT category_id,name FROM categories
            where category_id = ?";
        $params = [$category_id];
        $result = $this->fetch($sql, $params);
        if (!$result) {
            return false;
        }
        return $result;
    }

    // lấy các sản phẩm thuộc danh mục đó
    public function getProducts_ofCategory($category_id)
    {
        $sql = "SELECT p.product_id, p.name AS product_name, p.category_id, pt.product_type_id, pt.image, pt.priceOld, pt.priceCurrent, pt.discount_price
            FROM products p
            LEFT JOIN product_type pt 
                ON pt.product_id = p.product_id 
                AND pt.product_type_id = (
                    SELECT MIN(pt2.product_type_id) 
                    FROM product_type pt2 
                    WHERE pt2.product_id = p.product_id
                )
            WHERE p.category_id = ?
            limit 8";
        $params = [$category_id];
        $result = $this->fetchAll($sql, $params);

        return $result;
    }

    // Danh mục sản phẩm liên quan ở product detail
    public function get_relatedProducts($name_product)
    {
        $sql = "SELECT p.product_id, p.name AS product_name, pt.product_type_id, pt.image, pt.priceOld, pt.priceCurrent, pt.discount_price
        FROM products p
        JOIN product_type pt 
            ON p.product_id = pt.product_id
            AND pt.product_type_id = (
                SELECT MIN(pt2.product_type_id)
                FROM product_type pt2
                WHERE pt2.product_id = p.product_id
            )
        WHERE p.name LIKE ?
        ORDER BY pt.discount_price DESC
        LIMIT 8";
        $params = ["%$name_product%"];
        $result = $this->fetchAll($sql, $params);
        if (!$result) {
            return false;
        }
        return $result;
    }

    // lấy tất cả sản phẩm để hiển thị trong trang category product
    public function getSortedProducts($sort, $subProduct, $vt, $sd)
    {
        $orderBy = 'product_name ASC'; // mặc định
        $subProduct = "%$subProduct%";
        switch ($sort) {
            case 'name-desc':
                $orderBy = 'product_name DESC';
                break;
            case 'price-asc':
                $orderBy = 'pt.priceCurrent ASC';
                break;
            case 'price-desc':
                $orderBy = 'pt.priceCurrent DESC';
                break;
            case 'newest':
                $orderBy = 'pt.created_at DESC';
                break;
        }

        $sql = "
            SELECT 
                p.product_id,
                p.name AS product_name,
                pt.product_type_id,
                pt.image,
                pt.priceOld,
                pt.priceCurrent,
                pt.discount_price,
                pt.created_at
            FROM products p
            JOIN (
                SELECT * FROM product_type
                WHERE product_type_id IN (
                    SELECT MIN(product_type_id)
                    FROM product_type
                    GROUP BY product_id
                )
            ) pt ON p.product_id = pt.product_id
            WHERE p.name LIKE ?
            ORDER BY $orderBy
            LIMIT ?,?";
        $params = [$subProduct, $vt, $sd];
        $result = $this->fetchAll($sql, $params);

        return $result;
    }

    // đếm số sản phẩm lấy đc từ  getSortedProducts để phân trang trong category product
    public function countSortedProducts($subProduct)
    {
        $subProduct = "%$subProduct%";
        $sql = "SELECT  count(product_id) as count FROM products 
            WHERE name LIKE ?";
        $params = [$subProduct];
        $result = $this->fetch($sql, $params);

        return $result;
    }

    // lấy tất cả sản phẩm "khác" các danh mục có sẵn trong menu để hiển thị trong trang category product
    public function getAnotherProducts($sort, $vt, $sd)
    {
        $orderBy = 'product_name ASC'; // mặc định

        switch ($sort) {
            case 'name-desc':
                $orderBy = 'product_name DESC';
                break;
            case 'price-asc':
                $orderBy = 'pt.priceCurrent ASC';
                break;
            case 'price-desc':
                $orderBy = 'pt.priceCurrent DESC';
                break;
            case 'newest':
                $orderBy = 'pt.created_at DESC';
                break;
        }

        $sql = "
                    SELECT 
            p.product_id,
            p.name AS product_name,
            pt.product_type_id,
            pt.image,
            pt.priceOld,
            pt.priceCurrent,
            pt.discount_price,
            pt.created_at
        FROM products p
        JOIN (
            SELECT * FROM product_type
            WHERE product_type_id IN (
                SELECT MIN(product_type_id)
                FROM product_type
                GROUP BY product_id
            )
        ) pt ON p.product_id = pt.product_id
        WHERE p.name NOT LIKE '%Bút%' 
        AND p.name NOT LIKE '%Giấy%' 
        AND p.name NOT LIKE '%Vẽ%'
        ORDER BY $orderBy
        LIMIT ?,?";
        $params = [$vt, $sd];
        $result = $this->fetchAll($sql, $params);

        return $result;
    }

    // đếm số sản phẩm lấy đc từ  getAnotherProducts để phân trang trong category product
    public function countAnotherProducts()
    {
        $sql = "SELECT count(product_id) as count FROM products 
            WHERE name NOT LIKE '%Bút%' 
            AND name NOT LIKE '%Giấy%' 
            AND name NOT LIKE '%Vẽ%'";

        $result = $this->fetch($sql);

        return $result;
    }

    public function searchProduct($keySearch)
    {

        $sql = "
                SELECT 
                    p.product_id,
                    p.name AS product_name,
                    pt.product_type_id,
                    pt.image,
                    pt.priceOld,
                    pt.priceCurrent,
                    pt.discount_price
                FROM products p
                JOIN product_type pt ON pt.product_type_id = (
                    SELECT pt2.product_type_id
                    FROM product_type pt2
                    WHERE pt2.product_id = p.product_id
                    ORDER BY pt2.created_at DESC, pt2.product_type_id DESC
                    LIMIT 1
                )
                WHERE p.name LIKE CONCAT('%', ?, '%')
                ";

        $params = [$keySearch];
        $result = $this->fetchAll($sql, $params);
        return $result;
    }

    // lấy sản phẩm bán chạy nhất trong phần danh mục nổi bật
    public function allBestSelling_product()
    {
        $sql = "SELECT 
                p.product_id,
                p.name AS product_name,
                pt.product_type_id,
                pt.name AS product_type_name,
                pt.image,
                pt.priceCurrent,
                pt.priceOld,
                pt.stock_quantity,
                sales.total_sold
            FROM 
                (
                    SELECT 
                        pt.product_id,
                        pt.product_type_id,
                        SUM(od.quantity) AS total_sold
                    FROM 
                        order_details od
                    JOIN 
                        product_type pt ON od.product_type_id = pt.product_type_id
                    GROUP BY 
                        pt.product_type_id, pt.product_id
                ) AS sales
            JOIN (
                SELECT 
                    product_id,
                    MAX(total_quantity) AS max_quantity
                FROM (
                    SELECT 
                        pt.product_id,
                        SUM(od.quantity) AS total_quantity
                    FROM 
                        order_details od
                    JOIN 
                        product_type pt ON od.product_type_id = pt.product_type_id
                    GROUP BY 
                        pt.product_id, pt.product_type_id
                ) AS sub
                GROUP BY product_id
            ) AS best_sellers ON sales.product_id = best_sellers.product_id AND sales.total_sold = best_sellers.max_quantity
            JOIN 
                product_type pt ON pt.product_type_id = sales.product_type_id
            JOIN 
                products p ON p.product_id = pt.product_id
            ORDER BY 
                sales.total_sold DESC";
        $result = $this->fetchAll($sql);
        return $result;
    }

    // Cập nhật số lượng hàng tồn kho sau khi mua
    public function updateQuantity($newStock_quantity, $product_type_id)
    {
        $sql = "UPDATE product_type
                SET stock_quantity = ?
                WHERE product_type_id = ?";
        $params = [$newStock_quantity, $product_type_id];
        try {
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return true;
            } else {
                return "Cập nhật số lượng tồn kho thất bại!";
            }
        } catch (Exception $e) {
            // Xử lý lỗi nếu cần thiết
            return "Lỗi: " . $e->getMessage();
        }
    }

    public function getStockQuantity($product_type_id)
    {
        $sql = "SELECT stock_quantity FROM product_type WHERE product_type_id = ?";
        return $this->fetch($sql, [$product_type_id]);
    }

    // Phần quản lý sản phẩm
    // Quan lý sản phẩm trong admin
    public function getAllProducts()
    {
        $sql = "SELECT 
                p.product_id, 
                p.name AS product_name, 
                pt.image,
                pt.priceCurrent, 
                pt.stock_quantity, 
                pt.status AS product_status, 
                c.name AS category_name
            FROM products p
            INNER JOIN product_type pt ON p.product_id = pt.product_id
            INNER JOIN categories c ON p.category_id = c.category_id
        ";

        $result = $this->fetchAll($sql);
        return $result;
    }

    public function addProduct($name, $description, $category_id, $brand_id)
    {
        // Thêm sản phẩm vào bảng products
        $sql = "INSERT INTO $this->_table_products (`name`, `description`, `category_id`, `brand_id`) VALUES (?, ?, ?, ?)";
        $params = [$name, $description, $category_id, $brand_id];
        try {
            $affectedRows = $this->execute($sql, $params);
            if ($affectedRows > 0) {
                return $this->getInsertId(); //tra về id của order vừa tạo
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
