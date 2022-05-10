<?php
use App\Models\User;
//FOR Refund Payment
if(!function_exists('refund_payment')){
    function refund_payment($payload, $server_key)
    {
        $curl = curl_init('https://secure.paytabs.com/payment/request');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Authorization: '.$server_key.'',
            ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

 //FOR Voided Payment
if(!function_exists('voided_payment')){
    function voided_payment($payload, $server_key)
    {
        $curl = curl_init('https://secure.paytabs.com/payment/request');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Authorization: '.$server_key.'',
            ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

//FOR GENERATING INVOICE LINK
if(!function_exists('create_invoice_link')){
    function create_invoice_link($payload, $server_key)
    {
        $curl = curl_init('https://secure.paytabs.com/payment/new/invoice');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Authorization: '.$server_key.'',
            ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}
//FOR GENERATING LINK
if(!function_exists('create_tiny_url')){
    function create_tiny_url($url, $alias)
    {
        $curl = curl_init('https://api.tinyurl.com/create');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Accept: application/json',
            'Authorization: Bearer kNkwHCbi0rMxkOfvK5Hn7rn6DL6GOGSaVzjmHxVXYYpvWOCIUpOYKyWg7prT'
        ];
        $payload = [
            'url' => $url,
            'domain' => 'tinyurl.com',
            'alias' => $alias,
        ];
        // return $payload;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

//FOR Sending Messages
if(!function_exists('send_message')){
    function send_message($id, $number, $content)
    {
        $user = User::where('id', $id)->first();
        $admin = User::where('id', 1)->first();

        if($user->sender_id_by_number != "" && $user->sender_id_by_name != "" && $user->api_key != "")
        {
           $sender_id_by_number = $user->sender_id_by_number;
           $sender_id_by_name   = $user->sender_id_by_name;
           $api_key = $user->api_key;
           $active_sms_id = $user->active_sms_id;
        }
        else
        {
           $sender_id_by_number = $admin->sender_id_by_number;
           $sender_id_by_name   = $admin->sender_id_by_name;
           $api_key = $admin->api_key;
           $active_sms_id = $admin->active_sms_id;
        }


        if($active_sms_id == 1)
        {
            $brand_name = $sender_id_by_name;
        }
        else
        {
            $brand_name = $sender_id_by_number;
        }


        $curl = curl_init('http://www.elitbuzz-me.com/sms/smsapi?api_key='.$api_key.'&type=text&contacts=('.$number.')&senderid='.$brand_name.'&msg='.urlencode($content));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

//FOR GENERATING LINK
if(!function_exists('generate_link')){
    function generate_link($payload, $server_key)
    {
        $curl = curl_init('https://secure.paytabs.com/payment/request');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Authorization: '.$server_key.'',
            ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

//FOR GENERATING LINK
if(!function_exists('get_transaction_info')){
    function get_transaction_info($payload, $server_key)
    {
        $curl = curl_init('https://secure.paytabs.com/payment/query');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        $headers = [
            'Authorization: '.$server_key.'',
            ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $result = json_decode($curl_response, true, 512, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_FORCE_OBJECT);
        return $result;
    }
}

?>
