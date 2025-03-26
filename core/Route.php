<?php

class Route
{

    public function handRoute($url)
    {
        global $routes;
        unset($routes['default_controller']);
        echo '<br>';
        //       lấy url và xử lý thành key để so sánh
        $url = trim($url, '/');
        $handleUrl = $url;
        //        Neu $routes bên config khác rỗng thì duyệt qua toàn bộ các key để so sánh xem có key nào khớp
        // với đường dẫn không

        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match('~' . $key . '~is', $url)) {
                    $handleUrl = preg_replace('~' . $key . '~is', $value, $url);
                }
            }
        }

        return $handleUrl;
    }
}
