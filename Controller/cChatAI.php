<?php
include_once("Model/mChatAI.php");

class cChatAI {
    private $model;

    public function __construct() {
        $this->model = new mChatAI();
    }

    // Xử lý gửi tin nhắn
    function XuLyGuiTinNhan() {
        if(isset($_POST['gui_tin_nhan'])) {
            $user_id = $_POST['user_id'];
            $tin_nhan = $_POST['tin_nhan'];

            // Lấy ngữ cảnh sinh viên
            $context = $this->model->LayContextSV($user_id);

            // Lưu tin nhắn sinh viên
            $this->model->LuuTinNhan($user_id, 'user', $tin_nhan, $context);

            // Phản hồi từ AI (simulate - sau này gọi API AI thật)
            $phan_hoi = $this->TaoPhanHoiAI($tin_nhan, $context);

            // Lưu phản hồi AI
            $this->model->LuuTinNhan($user_id, 'ai', $phan_hoi, $context);

            return true;
        }
        return false;
    }

    // Tạo phản hồi từ AI (simulate - thay bằng API AI thật sau)
    private function TaoPhanHoiAI($cau_hoi, $context) {
        $context_arr = json_decode($context, true);
        $cau_hoi_lower = mb_strtolower($cau_hoi, 'UTF-8');

        // Các từ khóa để nhận diện câu hỏi
        $keywords = [
            'diem' => ['điểm', 'điểm thi', 'điểm số', 'điểm tb', 'gpa'],
            'lich' => ['lịch', 'thời khóa biểu', 'giờ học', 'ca học'],
            'baitap' => ['bài tập', 'nộp bài', 'bài nộp', 'hạn nộp'],
            'khoahoc' => ['khóa học', 'môn học', 'học phần', 'học gì'],
            'giao_vien' => ['giảng viên', 'thầy', 'cô', 'gv'],
            'thong_tin' => ['thông tin', 'hồ sơ', 'profile']
        ];

        // Kiểm tra từ khóa
        $loai_cau_hoi = null;
        foreach($keywords as $key => $words) {
            foreach($words as $word) {
                if(strpos($cau_hoi_lower, $word) !== false) {
                    $loai_cau_hoi = $key;
                    break 2;
                }
            }
        }

        // Tạo phản hồi dựa trên loại câu hỏi
        $phan_hoi = "";
        $ten_sv = isset($context_arr['student_info']['tensinhvien']) ? $context_arr['student_info']['tensinhvien'] : "bạn";

        switch($loai_cau_hoi) {
            case 'diem':
                if(!empty($context_arr['scores'])) {
                    $phan_hoi = "Chào $ten_sv! Đây là điểm gần đây của bạn:\n\n";
                    foreach($context_arr['scores'] as $d) {
                        $phan_hoi .= "- {$d['tenhocphan']}: Điểm TB {$d['diemtb']}\n";
                    }
                    $phan_hoi .= "\nBạn có muốn biết thêm chi tiết điểm từng phần (TK1, TK2, GK, CK...) không?";
                } else {
                    $phan_hoi = "Hiện tại mình chưa có thông tin điểm của bạn trong hệ thống. Bạn có thể kiểm tra lại sau nhé!";
                }
                break;

            case 'lich':
                if(!empty($context_arr['current_courses'])) {
                    $phan_hoi = "Dưới đây là các môn học hiện tại của bạn:\n\n";
                    foreach($context_arr['current_courses'] as $kh) {
                        $phan_hoi .= "- {$kh['tenhocphan']} ({$kh['mahocphan']}) - Lớp: {$kh['tenlophocphan']}\n";
                    }
                    $phan_hoi .= "\nBạn muốn xem lịch học chi tiết của môn nào?";
                } else {
                    $phan_hoi = "Mình chưa tìm thấy thông tin lịch học của bạn. Hãy kiểm tra lại sau nhé!";
                }
                break;

            case 'baitap':
                if(!empty($context_arr['pending_assignments'])) {
                    $phan_hoi = "Bạn có các bài tập cần nộp:\n\n";
                    foreach($context_arr['pending_assignments'] as $bt) {
                        $phan_hoi .= "- {$bt['tieude']} ({$bt['tenhocphan']}) - Hạn: {$bt['ketthucnop']}\n";
                    }
                } else {
                    $phan_hoi = "Hiện tại bạn không có bài tập nào cần nộp trong thời gian tới. Great job! 🎉";
                }
                break;

            case 'khoahoc':
                if(!empty($context_arr['current_courses'])) {
                    $phan_hoi = "Các khóa học hiện tại của $ten_sv:\n\n";
                    foreach($context_arr['current_courses'] as $kh) {
                        $phan_hoi .= "📚 {$kh['tenhocphan']}\n";
                        $phan_hoi .= "   Mã HP: {$kh['mahocphan']}\n";
                        $phan_hoi .= "   Lớp: {$kh['tenlophocphan']}\n\n";
                    }
                } else {
                    $phan_hoi = "Bạn hiện chưa đăng ký khóa học nào.";
                }
                break;

            case 'giao_vien':
                $phan_hoi = "Để xem thông tin giảng viên, bạn vui lòng vào mục 'Chi tiết khóa học' trong từng môn học nhé. Thông tin giảng viên sẽ được hiển thị cụ thể.";
                break;

            case 'thong_tin':
                $sv = $context_arr['student_info'];
                $phan_hoi = "Thông tin cá nhân của $ten_sv:\n\n";
                $phan_hoi .= "👤 Họ tên: {$sv['tensinhvien']}\n";
                $phan_hoi .= "🎓 Mã SV: {$sv['user_code']}\n";
                $phan_hoi .= "📧 Email: {$sv['email']}\n";
                $phan_hoi .= "🏫 Khoa: {$sv['tenkhoa']}\n";
                $phan_hoi .= "📚 Chuyên ngành: {$sv['tenchuyennganh']}\n";
                break;

            default:
                $phan_hoi = "Xin chào $ten_sv! 👋\n\n";
                $phan_hoi .= "Mình là trợ lý AI của hệ thống quản lý học vụ. Mình có thể giúp bạn:\n\n";
                $phan_hoi .= "📊 Xem điểm số\n";
                $phan_hoi .= "📅 Xem lịch học\n";
                $phan_hoi .= "📝 Xem bài tập cần nộp\n";
                $phan_hoi .= "📚 Thông tin khóa học\n";
                $phan_hoi .= "👤 Thông tin cá nhân\n\n";
                $phan_hoi .= "Bạn cần hỗ trợ gì?";
                break;
        }

        return $phan_hoi;
    }

    // Lấy lịch sử chat
    function LayLichSuChat($user_id) {
        return $this->model->LayLichSuChat($user_id);
    }

    // Xóa lịch sử chat
    function XoaLichSuChat($user_id) {
        return $this->model->XoaLichSuChat($user_id);
    }
}
?>
