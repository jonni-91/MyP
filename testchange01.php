<?php
//Проверка
//Проверка ветки
$data = array(
array('ID'=>100, 'PARENT_ID' => 0, 'NAME'=> 'Ïóíêò 1',),
array('ID'=>2, 'PARENT_ID' => 0, 'NAME'=> 'Ïóíêò 2',),
array('ID'=>4, 'PARENT_ID' => 0, 'NAME'=> 'Ïóíêò 4',),
array('ID'=>52, 'PARENT_ID' => 100, 'NAME'=> 'Ïóíêò 1.1',),
array('ID'=>6, 'PARENT_ID' => 100, 'NAME'=> 'Ïóíêò 1.2',),
array('ID'=>7, 'PARENT_ID' => 100, 'NAME'=> 'Ïóíêò 1.3',),
array('ID'=>8, 'PARENT_ID' => 100, 'NAME'=> 'Ïóíêò 1.4',),
array('ID'=>9, 'PARENT_ID' => 52, 'NAME'=> 'Ïóíêò 1.1.1',),
array('ID'=>10, 'PARENT_ID' => 52, 'NAME'=> 'Ïóíêò 1.1.2',),
array('ID'=>11, 'PARENT_ID' => 52, 'NAME'=> 'Ïóíêò 1.1.3',),
array('ID'=>12, 'PARENT_ID' => 52, 'NAME'=> 'Ïóíêò 1.1.4',),
array('ID'=>13, 'PARENT_ID' => 9, 'NAME'=> 'Ïóíêò 1.1.1.1',),
array('ID'=>14, 'PARENT_ID' => 9, 'NAME'=> 'Ïóíêò 1.1.1.2',),
array('ID'=>15, 'PARENT_ID' => 9, 'NAME'=> 'Ïóíêò 1.1.1.3',),
array('ID'=>16, 'PARENT_ID' => 9, 'NAME'=> 'Ïóíêò 1.1.1.4',),
array('ID'=>87, 'PARENT_ID' => 2, 'NAME'=> 'Ïóíêò 2.1',),
array('ID'=>18, 'PARENT_ID' => 2, 'NAME'=> 'Ïóíêò 2.2',),
array('ID'=>19, 'PARENT_ID' => 3, 'NAME'=> 'Ïóíêò 3.1',),
array('ID'=>20, 'PARENT_ID' => 3, 'NAME'=> 'Ïóíêò 3.2',),
array('ID'=>3, 'PARENT_ID' => 0, 'NAME'=> 'Ïóíêò 3',),
array('ID'=>21, 'PARENT_ID' => 4, 'NAME'=> 'Ïóíêò 4.1',),
array('ID'=>22, 'PARENT_ID' => 4, 'NAME'=> 'Ïóíêò 4.2',),
array('ID'=>23, 'PARENT_ID' => 87, 'NAME'=> 'Ïóíêò 2.1.1',),
array('ID'=>24, 'PARENT_ID' => 87, 'NAME'=> 'Ïóíêò 2.1.2',),
array('ID'=>25, 'PARENT_ID' => 23, 'NAME'=> 'Ïóíêò 2.1.1.1',),
array('ID'=>26, 'PARENT_ID' => 23, 'NAME'=> 'Ïóíêò 2.1.1.2',),
array('ID'=>27, 'PARENT_ID' => 19, 'NAME'=> 'Ïóíêò 3.1.1',),
array('ID'=>28, 'PARENT_ID' => 19, 'NAME'=> 'Ïóíêò 3.1.2',),
array('ID'=>1, 'PARENT_ID' => 20, 'NAME'=> 'Ïóíêò 3.2.1',),
array('ID'=>30, 'PARENT_ID' => 1, 'NAME'=> 'Ïóíêò 3.2.1.1'));

$volume  = array_column($data, 'NAME');
array_multisort($volume, SORT_ASC, SORT_STRING, $data);

$arrayNew = $data;
$end = array(array('ID'=>'', 'PARENT_ID' => '', 'NAME'=> ''));
array_push($arrayNew, $end);

foreach( $arrayNew as $key => $val ){$arrayNew[$key]['lvl']=0;}

foreach( $arrayNew as $key => $val ){
	for($i=0; $i<count($arrayNew);$i++)
	{
		if($val['PARENT_ID']==$arrayNew[$i]['ID']){
			$arrayNew[$key]['lvl'] = $arrayNew[$i]['lvl']+1;
		}
	}
}

foreach ($arrayNew as $key => $val){	
    $lvl=$val['lvl'];
	if($key==0) {echo "<ul>\n<li>".$val['NAME'];} 
	elseif($val['lvl']>$arrayNew[$key-1]['lvl']){
	    if($val['PARENT_ID']==$arrayNew[$key-1]['ID']) {echo "<ul>\n";}
		echo "<li>".$val['NAME']; 
		if($val['PARENT_ID']==$arrayNew[$key+1]['PARENT_ID']||$val['lvl']>$arrayNew[$key+1]['lvl']) {echo "</li>\n";}
	}
	elseif($val['lvl']==$arrayNew[$key-1]['lvl']){
	    echo "<li>".$val['NAME']."</li>\n"; 
	}
	elseif($val['lvl']<$arrayNew[$key-1]['lvl']){
	    $lvlprev=$arrayNew[$key-1]['lvl'];
	   if($val['PARENT_ID']!=$arrayNew[$key-1]['ID']) {
		    while($lvlprev>$val['lvl']){
	    	    echo "</ul>\n</li>\n";
		        $lvlprev--;
		    }
		}
		if($val['lvl']==0) echo "<li>".$val['NAME']."\n"; 
		elseif($val['ID']!=$arrayNew[$key+1]['PARENT_ID']) echo "<li>".$val['NAME']."</li>\n";
		elseif($key!=count($arrayNew)-1) {echo "<li>".$val['NAME']."\n";}
		else {echo "</ul>";}
	}
}

