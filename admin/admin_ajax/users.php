<?php
    require('../admin_components/db_config.php');
    require('../admin_components/essentials.php');
    adminLogin();

    if(isset($_POST['get_users']))
    {  
       $res = selectAll('user_details');
       $i=1;
       $data ="";

       while($row = mysqli_fetch_assoc($res)){
        $del_btn ="<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none' style='padding: 8px 15px; border-radius: 6px;'>
            <i class='bi bi-trash'></i>
            </button>";

        $verified = "<span style='background: linear-gradient(135deg, var(--warning) 0%, #E67200 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;'><i class='bi bi-x-lg'></i></span>";

        if($row['is_verified']) {
        $verified = "<span style='background: linear-gradient(135deg, var(--success) 0%, #256655 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;'><i class='bi bi-check-lg'></i></span>";
        $del_btn = "";
        }

        $status ="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none' style='padding: 8px 15px; border-radius: 6px; font-weight: 600;'> Active </button>";

        if(!$row['status']){
        $status ="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none' style='padding: 8px 15px; border-radius: 6px; font-weight: 600;'> Inactive </button>";
        }

        $date = date("d-m-Y",strtotime($row['date_and_time']));

        $data .="
        <tr style='transition: all 0.3s ease;'>
            <td style='font-weight: 600; color: var(--admin-primary);'>$i</td>
            <td style='color: var(--text-dark); font-weight: 600;'>$row[name]</td>
            <td style='color: var(--text-dark);'>$row[email]</td>
            <td style='color: var(--text-dark);'>$row[phone_num]</td>
            <td style='color: var(--text-dark);'>$row[address] | $row[pincode]</td>
            <td style='color: var(--text-dark);'>$row[dob]</td>
            <td>$verified</td>
            <td>$status</td>
            <td style='color: var(--text-dark);'>$date</td>
            <td>$del_btn</td>
        </tr>
         ";
         $i++;
       }
        echo $data;
    }
 
    if(isset($_POST['toggle_status']))
    {
        $frm_data = filteration($_POST);
        $q = "UPDATE `user_details` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];

        if(update($q,$v,'ii')){
            echo 1;
        }
        else{
            echo 0;
        }
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
        $del_btn ="<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none' style='padding: 8px 15px; border-radius: 6px;'>
            <i class='bi bi-trash'></i>
            </button>";

        $verified = "<span style='background: linear-gradient(135deg, var(--warning) 0%, #E67200 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;'><i class='bi bi-x-lg'></i></span>";

        if($row['is_verified']) {
        $verified = "<span style='background: linear-gradient(135deg, var(--success) 0%, #256655 100%); color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;'><i class='bi bi-check-lg'></i></span>";
        $del_btn = "";
        }

        $status ="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none' style='padding: 8px 15px; border-radius: 6px; font-weight: 600;'> Active </button>";

        if(!$row['status']){
        $status ="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none' style='padding: 8px 15px; border-radius: 6px; font-weight: 600;'> Inactive </button>";
        }

        $date = date("d-m-Y",strtotime($row['date_and_time']));

        $data .="
        <tr style='transition: all 0.3s ease;'>
            <td style='font-weight: 600; color: var(--admin-primary);'>$i</td>
            <td style='color: var(--text-dark); font-weight: 600;'>$row[name]</td>
            <td style='color: var(--text-dark);'>$row[email]</td>
            <td style='color: var(--text-dark);'>$row[phone_num]</td>
            <td style='color: var(--text-dark);'>$row[address] | $row[pincode]</td>
            <td style='color: var(--text-dark);'>$row[dob]</td>
            <td>$verified</td>
            <td>$status</td>
            <td style='color: var(--text-dark);'>$date</td>
            <td>$del_btn</td>
        </tr>
         ";
         $i++;
       }
        echo $data;
    }





?>