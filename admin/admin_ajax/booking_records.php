<?php
    require('../admin_components/db_config.php');
    require('../admin_components/essentials.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {  
        $form_data = filteration($_POST);

        $limit = 1;
        $page = $form_data['page'];
        $start = ($page - 1) * $limit;

        $query = "SELECT bo.* , bd.* FROM `booking_order` bo 
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
        WHERE ((bo.booking_status = 'booked' AND bo.arrival = 1) OR (bo.booking_status='cancelled' AND bo.refund = 1))
        AND (bo.order_id LIKE ? OR bd.phone_num LIKE ? OR bd.user_name LIKE ?)
        ORDER BY bo.booking_id DESC";

        $res = select($query,["%$form_data[search]%","%$form_data[search]%","%$form_data[search]%"],'sss');

        $limit_query = $query ." LIMIT $start,$limit";

        $limit_res = select($limit_query,["%$form_data[search]%","%$form_data[search]%","%$form_data[search]%"],'sss');


        $total_rows = mysqli_num_rows($res);

        if($total_rows == 0) {
            $output = json_encode(['table_data' => "<tr><td colspan='6' class='text-center'><div style='padding: 40px;'><i class='bi bi-inbox' style='font-size: 3rem; color: var(--admin-gold);'></i><h5 style='color: var(--admin-primary); margin-top: 15px;'>No Data Found</h5></div></td></tr>","pagination"=>'']);
            echo $output;
            exit;
        }

        $i=$start+1;
        $table_data = "";

        while($data = mysqli_fetch_assoc($limit_res)) {
            $date = date("d-m-Y",strtotime($data['order_date']));
            $checkin = date("d-m-Y",strtotime($data['check_in']));
            $checkout = date("d-m-Y",strtotime($data['check_out']));

            if($data['booking_status'] == 'booked'){
                $status_bg = 'style="background: linear-gradient(135deg, var(--success) 0%, #256655 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;"';
            }
            else if($data['booking_status'] == 'cancelled'){
                $status_bg = 'style="background: linear-gradient(135deg, var(--danger) 0%, #A00F1F 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;"';
            }
            else {
                $status_bg = 'style="background: linear-gradient(135deg, var(--warning) 0%, #E67200 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;"';
            }

            $table_data .= "
                <tr style='transition: all 0.3s ease;'>
                <td style='font-weight: 600; color: var(--admin-primary);'>$i</td>
                <td>
                    <span style='background: linear-gradient(135deg, var(--info) 0%, #3A6B8A 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600; display: inline-block; margin-bottom: 8px;'>
                        Order ID: $data[order_id]
                    </span>
                    <br>
                    <b style='color: var(--admin-primary);'>Name:</b> $data[user_name]
                    <br>
                    <b style='color: var(--admin-primary);'>Phone:</b> $data[phone_num]
                </td>
                <td>
                    <b style='color: var(--admin-primary);'>Room:</b> $data[room_name]
                    <br>
                    <b style='color: var(--admin-primary);'>Price:</b> <span style='color: var(--admin-gold); font-weight: 700;'>₹$data[price]</span>
                </td>

                <td>
                    <b style='color: var(--admin-primary);'>Amount:</b> <span style='color: var(--admin-gold); font-weight: 700;'>₹$data[total_pay]</span>
                    <br>
                    <b style='color: var(--admin-primary);'>Date:</b> $date
                </td>

                <td>
                    <span $status_bg>$data[booking_status]</span>
                </td>

                <td>   
                <button type='button' onclick='download($data[booking_id])' class='btn btn-success btn-sm fw-bold shadow-none' style='padding: 8px 15px; border-radius: 6px;'>
                   <i class='bi bi-download me-1'></i> Download
                </button>
                </td>
                </tr>
                ";
            $i++;
        }


        $pagination = "";

        if($total_rows > $limit) {

           $total_pages = ceil($total_rows/$limit);


           if($page != 1) {
            $pagination .= "<li class='page-item'><button onclick='change_page(1)' class='page-link shadow-none'> First </button></li>";
            }


           $disabled = ($page == 1) ? "disabled" : "";
           $prev = $page - 1;
           $pagination .= "<li class='page-item $disabled'><button onclick='change_page($prev)' class='page-link shadow-none'> Prev </button></li>";
           
           $disabled = ($page == $total_pages) ? "disabled" : "";
           $next = $page + 1;
           $pagination .= "<li class='page-item $disabled'><button onclick='change_page($next)' class='page-link shadow-none'> Next </button></li>";


            if($page != $total_pages) {
            $pagination .= "<li class='page-item'><button onclick='change_page($total_pages)' class='page-link shadow-none'> Last </button></li>";
            }

        }

        $output = json_encode(["table_data"=>$table_data,"pagination"=>$pagination]);
        echo $output;


    }


    if (isset($_POST['get_calendar_bookings'])) {
    $query = "SELECT bo.booking_id, bd.user_name, bd.phone_num, bd.room_name, bo.check_in, bo.check_out 
              FROM booking_order bo 
              INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id 
              WHERE bo.booking_status='booked' AND bo.arrival=1";

    $res = mysqli_query($con, $query);

    $events = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $events[] = [
            'title' => $row['user_name'] . ' - ' . $row['room_name'],
            'start' => $row['check_in'],
            'end' => date('Y-m-d', strtotime($row['check_out'] . ' +1 day')),
            'extendedProps' => [
                'phone' => $row['phone_num'],
                'booking_id' => $row['booking_id']
            ]
        ];
    }

    echo json_encode($events);
    exit;
}


    if(isset($_POST['remove_user'])){
         $frm_data = filteration($_POST);
         $res = delete("DELETE FROM `user_details` WHERE `id`=? AND `is_verified`=?",[$frm_data['user_id'],0],'ii');

        if($res){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['search_user']))
    {  
        $form_data = filteration($_POST);
        $query = "SELECT * FROM `user_details` WHERE `name` LIKE ?";

        $res = select($query,["%$form_data[name]%"],'s');
        $i=1;
        $data ="";

        while($row = mysqli_fetch_assoc($res)){
        $del_btn ="<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none'>
            <i class='bi bi-trash'></i>
            </button>";

        $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";

        if($row['is_verified']) {
        $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
        $del_btn = "";
        }

        $status ="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'> active </button>";

        if(!$row['status']){
        $status ="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'> inactive </button>";
        }

        $date = date("d-m-Y",strtotime($row['date_and_time']));

        $data .="
        <tr>
            <td>$i</td>
            <td>
                <img src='$path$row[profile]' width='55px'>
                <br>
                $row[name]
            </td>
            <td>$row[email]</td>
            <td>$row[phone_num]</td>
            <td>$row[address] | $row[pincode]</td>
            <td>$row[dob]</td>
            <td>$verified</td>
            <td>$status</td>
            <td>$date</td>
            <td>$del_btn</td>
        </tr>
         ";
         $i++;
       }
        echo $data;
    }





?>