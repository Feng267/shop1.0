<div id='big_top_bar'>
    <table id='nav_table'>
        <tr>
            <td id="logo"></td>
            <td><a href='index.php'>主页</a></td>

            <td><a href='shoppingCart.php'>购物车</a></td>

            <td><a href='order_info.php'>订单</a></td>

            <td><a href='user_center.php'>我的</a></td>

            <td id="LogInName"><a href='login.php'>登录</a></td>
            <td id="icon"></td>
            <td id="out"></td>
        </tr>
    </table>
</div>
<?php
    if(!session_id())
        session_start();
    include 'allPhpfun.php';
?>