<?php
function miKey()
{
	$key = hash("sha512", "SoyGreenTechEIM2024");
	return $key;
}

function encryptData($data)
{
	$key = miKey();
	$algorithm = 'bf-cbc';
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($algorithm));
	$encrypted_data = openssl_encrypt($data, $algorithm, $key, 0, $iv);
	$result = base64_encode($iv . $encrypted_data);
	return $result;
}

function decryptData($encryptedData)
{
	$key = miKey();
	$algorithm = 'bf-cbc';
	$decoded_data = base64_decode($encryptedData);
	$iv_size = openssl_cipher_iv_length($algorithm);
	$iv = substr($decoded_data, 0, $iv_size);
	$encrypted_data = substr($decoded_data, $iv_size);
	$result = openssl_decrypt($encrypted_data, $algorithm, $key, 0, $iv);
	return $result;
}
?>