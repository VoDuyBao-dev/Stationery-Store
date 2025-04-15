<?php

class ProductModel extends Model
{
    private $_table_products = 'products';
    private $_table_product_type = 'product_type';


    public function get_BestSellingProducts()
    {
        $sql = "WITH best_selling_products AS (
    -- Lấy danh sách 10 sản phẩm có lượt bán cao nhất
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
        $sql = "SELECT * FROM product_images where product_id = ?";
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
            limit 6";
        $params = [$category_id];
        $result = $this->fetchAll($sql, $params);
        if (!$result) {
            return false;
        }
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
        LIMIT 10";
        $params = ["%$name_product%"];
        $result = $this->fetchAll($sql, $params);
        if (!$result) {
            return false;
        }
        return $result;
    }
}
