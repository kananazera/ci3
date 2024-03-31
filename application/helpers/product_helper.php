<?php

function generatePrice($price, $discount_rate)
{
	$price_discount_rate = ($price * $discount_rate / 100);
	$price_with_discount = ($price - $price_discount_rate);

	setlocale(LC_MONETARY, 'en_US');

	return number_format($price_with_discount, 2, '.', '');
}
