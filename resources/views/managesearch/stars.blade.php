
<?php $s = App\TwitterModel::getSentiStars($d->senti_neg, $d->senti_pos, $d->senti_neu); 

if($s == 'neg'){
?>
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/e-star.png') }}">
<img src="{{ asset('public/images/e-star.png') }}">
<img src="{{ asset('public/images/e-star.png') }}">
<img src="{{ asset('public/images/e-star.png') }}">
<?php
} else if($s == 'pos')
{
 ?>
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/w-star.png') }}">
 <?php   
} else{
 ?>
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/w-star.png') }}">
<img src="{{ asset('public/images/e-star.png') }}">
<img src="{{ asset('public/images/e-star.png') }}">
 <?php   
}
?>



