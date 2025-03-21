<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SoalModel');
    }

    public function index()
    {
        $this->load->model('SoalModel');
        $data['soal'] = $this->SoalModel->get_all_soal();
        $this->load->view('user/soal/index', $data);
    }

    public function updateDiscussId()
    {
        $discussId = $this->input->post('discuss_id');

        if (empty($discussId)) {
            echo json_encode(["status" => "error", "message" => "Discuss ID is missing"]);
            return;
        }

        // Simpan discuss_id ke sesi atau database
        $this->session->set_userdata('discuss_id', $discussId);
        echo json_encode(["status" => "success", "message" => "Discuss ID updated"]);
    }


    public function submit_quiz()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['answers']) || !is_array($input['answers'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        $quiz_data = [];
        foreach ($input['answers'] as $answer) {
            if (!isset($answer['discuss_id'], $answer['ans_opt'])) {
                continue;
            }

            $discuss_id = $answer['discuss_id'];
            $ans_opt = $answer['ans_opt'];

            $query = $this->db->select("ans_$ans_opt as ans_val")
                ->where('discuss_id', $discuss_id)
                ->get('discuss');
            $row = $query->row();

            if (!$row) {
                continue;
            }

            $quiz_data[] = [
                'user_id' => $user_id,
                'discuss_id' => $discuss_id,
                'ans_opt' => $ans_opt,
                'ans_val' => $row->{"ans_$ans_opt"},
            ];
        }

        if (!empty($quiz_data)) {
            $inserted = $this->db->insert_batch('user_quiz', $quiz_data);
            if ($inserted) {
                echo json_encode(['status' => 'success', 'message' => 'Quiz submitted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save data']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No valid answers submitted']);
        }
    }
}
