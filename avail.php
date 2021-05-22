<?php


// Settings
$district_id = <YOUR_DISTRICT_ID>;
$check_for_next_n_days = <FROM_TODAY_DAYS_TO_CHECK>;
$message = <MESSAGE_AS_YOU_WANT>;
// Example: $message = "{available_capacity} [first: {available_capacity_dose1}, second: {available_capacity_dose2}] \nat **{name}** {address} \non {date}\nFees: {fee_type}\nVaccine Name: {vaccine}";

// Change condition if you needed.
function condition($item) {
  return (
    // $item->center_id == 692858 &&
    ($item->available_capacity > 0 || $item->available_capacity_dose1 > 0) &&
    $item->min_age_limit < 20
  );
}

function notify($msg) {
  print($msg);

  $discord_url = <DISCORD_WEBHOOK_URL>;
  // Example: $discord_url = "https://discord.com/api/webhooks/###########/xxxxxxxxxxxxxxxxxxxxxxx"

  $data = array(
    'content' => $msg,
    'username' => "Vaccine Available"
  );
  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($discord_url, false, $context);
}

function prepare_message($template, $obj) {
  $msg = $template;
  $data = is_object($obj) ? get_object_vars($obj): $obj;
  foreach($data as $key => $val) {
    $splited = explode("{{$key}}", $msg);
    if(count($splited) > 1) {
      $msg = implode($val, $splited);
    }
  }
  return $msg;
}

function find_slot($did, $days, $msg) {
  $time = time();
  $day = 60*60*24;

  while ($days > 0) {
    $days -= 1;
    $dt = date('d-m-Y', $time);
    $json = file_get_contents("https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByDistrict?district_id=$did&date=$dt");
    $data = json_decode($json);
    $list = $data->sessions;
    foreach($list as $item) {
      if(condition($item)) {
        notify(prepare_message($msg, $item));
      }
    }
    $time += $day;
  }
}

// find_slot($district_id, $check_for_next_n_days, $message);
while(1) { find_slot($district_id, $check_for_next_n_days, $message); }

?>
