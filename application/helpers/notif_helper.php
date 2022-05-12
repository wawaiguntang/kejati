<?php

function checkNotif()
{
    $CI = &get_instance();
    $notif = [];
    $userCode = $CI->session->userdata('userCode');

    if ($userCode == NULL) {
        $notif;
    } else {
        $notif = $CI->db->order_by('id', "DESC")->get_where('notifikasi', ['to' => $userCode, 'isRead' => 0, 'deleteAt' => NULL])->result_array();
    }
    $html = '';
    foreach ($notif as $n => $f) {
        $html .= '
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="' . json_decode($f['data'], true)['link'] . '/'.$f['id'].'">
                                <div class="d-flex py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            ' . $f['description'] . '
                                        </h6>
                                        <p class="text-xs text-secondary mb-0 ">
                                            <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                            ' . time_ago($f['createAt']) . '
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
        ';
    }
    return $html;
}
