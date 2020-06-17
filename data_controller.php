<?php
require 'connection.php';
require 'restful_api.php';
/**
 * summary
 */
class data_controller extends restful_api {
    
    private $db;
    private $connection;
    private $query_sp = "SELECT sanpham.mahoa as 'Mã hóa thiết bị', sanpham.tenthietbi as 'Tên thiết bị', sanpham.mota as 'Mô tả', sanpham.nhasx as 'Nhà sản xuất', ";
    private $query_sp_amount = "sanpham_amount.dongianhapkho as 'Đơn giá nhập kho', sanpham_amount.sl_tonkho_min as 'Số lượng tồn kho nhỏ nhất', sanpham_amount.sl_tonkho_max as 'Số lượng tồn kho lớn nhất', sanpham_amount.sl_hienhuu as 'Số lượng hiện hữu', sanpham_amount.donvitinh as 'Đơn vị tính', sanpham_amount.tonggiatri as 'Tổng giá trị', ";
    private $query_sp_info = "sanpham_info.vt_sudung as 'Vị trí sử dụng', sanpham_info.vt_kho as 'Vị trí trong kho', sanpham_info.lichsu_nhap as 'Lịch sử nhập hàng', sanpham_info.tailieu as 'Tài liệu đính kèm', sanpham_info.hinhanh as 'Hình ảnh', sanpham_info.cachthucmua as 'Cách thức mua'";
    private $query_tab = "from sanpham inner join sanpham_amount on sanpham.mathietbi = sanpham_amount.mathietbi inner join sanpham_info on sanpham.mathietbi = sanpham_info.mathietbi";

    public function __construct() {
        $this->db = new DB_connection();
        $this->connection = $this->db->get_connection();
        parent::__construct();
    }
    function data_request() {
        
    }
    function getData() {
        //quan ly kho view
        $query1 = $this->query_sp;
        $query2 = $this->query_sp_amount;
        $query3 = $this->query_sp_info;
        $query4 = $this->query_tab;
        $final_query = $query1. "" .$query2. "" .$query3. "" .$query4;
        //join query
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
        $mathietbi = $_GET['mathietbi'];
        if (isset($mathietbi)) {
            $query1 = $this->query_sp;
            $query2 = $this->query_sp_amount;
            $query3 = $this->query_sp_info;
            $query4 = $this->query_tab;
            $query = $query1. "" .$query2. "" .$query3. "" .$query4. " where sanpham.mathietbi = '".$mathietbi."'";
            $result = mysqli_query($this->connection, $query);
            $json_arr = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $json_arr[] = $row;
            }
            if (isset($json_arr)) {
                return $this->response(200, $json_arr);
            }
            return $this->response(404);
        }
        return $this->response(404);
    }
}
$data = new data_controller();
?>