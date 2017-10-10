<?php
//for admin site logo function 
function Site_logo()
{
	$data = DB::table('gerenal-settings')->select('site_logo')->first();
	$image = asset('public/assets/images/'.$data->site_logo);
   	return $image; 
}
//for admin profile image function
function profile_image()
{
	$id = Auth::user()->id;
	$data = DB::table('users')->where('id',$id)->select('profile_image')->first();
	$image = asset('public/assets/images/'.$data->profile_image);
   	return $image; 
}
//for user image path  common url acess 
function getUserImage($image)
{
	$image = asset('public/assets/images/users/'.$image);
	return $image;
}

function DobSum($date){
	if(isset($date)){
		$data = explode("/", $date);
		$dd = implode('', $data);
		$num = strlen($dd);
		$sum = 0;
		$total=0;
		$sum = getTotal($dd);
		$len = strlen($sum);
		if($len >1){
			getTotal((string)$sum);
		}
	}
	return $sum;
}

function getTotal($val){
	$sum = 0;
	$len = strlen($val);
	for($i=0; $i<$len; $i++){
		$sum+=$val[$i];
	}
	if(strlen($sum)>1){
		return getTotal((string)$sum);
	} else {
		return $sum;
	}
	return $sum;
}



?>