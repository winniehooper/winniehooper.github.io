<?php

function set_message($message, $type = 'success') {
	request()->session()->flash($type, $message);
}

function get_message($type = 'success', $forget = true) {
	$message = session($type);

	if ($forget) {
		request()->session()->forget($type);
	}

	return $message;
}

function plural_form($n) {
    return $n%10==1&&$n%100!=11?0:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?1:2);
}
