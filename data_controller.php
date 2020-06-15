<?php
require 'connection.php';
require 'restful_api.php';
/**
 * summary
 */
class data_controller extends restful_api {
    
    private $db;
    private $connection;

    public function __construct() {
        $this->db = new DB_connection();
        $this->connection = $this->db->get_connection();
        parent::__construct();
    }
    function data_request() {
        
    }
    function getData() {
        //quan ly kho view
        $query_sp = "SELECT sanpham.mahoa as 'Mã hóa thiết bị', sanpham.tenthietbi as 'Tên thiết bị', sanpham.mota as 'Mô tả', sanpham.nhasx as 'Nhà sản xuất', ";
        $query_sp_amount = "sanpham_amount.dongianhapkho as 'Đơn giá nhập kho', sanpham_amount.sl_tonkho_min as 'Số lượng tồn kho nhỏ nhất', sanpham_amount.sl_tonkho_max as 'Số lượng tồn kho lớn nhất', sanpham_amount.sl_hienhuu as 'Số lượng hiện hữu', sanpham_amount.donvitinh as 'Đơn vị tính', sanpham_amount.tonggiatri as 'Tổng giá trị', ";
        $query_sp_info = "sanpham_info.vt_sudung as 'Vị trí sử dụng', sanpham_info.vt_kho as 'Vị trí trong kho', sanpham_info.lichsu_nhap as 'Lịch sử nhập hàng', sanpham_info.tailieu as 'Tài liệu đính kèm', sanpham_info.hinhanh as 'Hình ảnh', sanpham_info.cachthucmua as 'Cách thức mua'";
        $query_tab = "from sanpham inner join sanpham_amount on sanpham.mathietbi = sanpham_amount.mathietbi inner join sanpham_info on sanpham.mathietbi = sanpham_info.mathietbi";
        //join query
        $final_query = $query_sp. "" .$query_sp_amount. "" .$query_sp_info. "" .$query_tab;
        $result = mysqli_query($this->connection, $final_query);
        $json_arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json_arr[] = $row;
        }
        if (isset($json_arr)) {
            return $this->response(200, $json_arr);
        }
        return $this->response(404);
    }
    function getDatabyId() {

    }
}
$data = new data_controller();
?>