<?php
/*************************************************************
 * ע�⣺�˴����趨Ĭ��ʱ��Ϊ����ʱ��
 *************************************************************/
date_default_timezone_set('PRC');

function concat_string($array) {
	$arg  = "";
	while (list ($key, $val) = each ($array)) {
		$arg.=$key."=".$val."&";
	}
	$arg = substr($arg,0,count($arg)-2); //ȥ�����һ��&�ַ�
	return $arg;
}

/**
 * ����������
 * $array ����ǰ������
 * return ����������
 */
function arg_sort($array) {
	ksort($array);
	reset($array);
	return $array;
}

/**
 * ʵ�ֶ����ַ����뷽ʽ
 * $input ��Ҫ������ַ���
 * $_output_charset ����ı����ʽ
 * $_input_charset ����ı����ʽ
 * return �������ַ���
 */
function charset_encode($input,$_output_charset ,$_input_charset) {
	$output = "";
	if(!isset($_output_charset))$_output_charset = $_input_charset;
	if($_input_charset == $_output_charset || $input ==null ) {
		$output = $input;
	} elseif (function_exists("mb_convert_encoding")) {
		$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
	} elseif(function_exists("iconv")) {
		$output = iconv($_input_charset,$_output_charset,$input);
	} else die("sorry, you have no libs support for charset change.");
	return $output;
}

/**
 * ʵ�ֶ����ַ����뷽ʽ
 * $input ��Ҫ������ַ���
 * $_output_charset ����Ľ����ʽ
 * $_input_charset ����Ľ����ʽ
 * return �������ַ���
 */
function charset_decode($input,$_input_charset ,$_output_charset) {
	$output = "";
	if(!isset($_input_charset) )$_input_charset = $_input_charset ;
	if($_input_charset == $_output_charset || $input ==null ) {
		$output = $input;
	} elseif (function_exists("mb_convert_encoding")) {
		$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
	} elseif(function_exists("iconv")) {
		$output = iconv($_input_charset,$_output_charset,$input);
	} else die("sorry, you have no libs support for charset changes.");
	return $output;
}

/********************************************************************************/

$server_url = 'http://tcopenapi.17usoft.com/handlers/scenery/queryhandler.ashx';	//�ӿڵ�ַ������ʽ��url

$version = '20111128102912';							//�ӿ�Э��汾�ţ�����ӿ�Э���ĵ�
$accountID = 'd934f05d-bb84-46b2-ac90-d1bb595e4911';	//API�ʻ�ID(Сд)������������ͨ����
$accountKey = '2a8920a5baaeffb2';		//API�ʻ���Կ������������ͨ���󷢷�
$serviceName = 'GetSceneryList';							//���ýӿڵķ�������
$currentMS =  (int)(microtime()*1000); 					//��ǰʱ��ĺ���
$reqTime = date("Y-m-d H:i:s").".".$currentMS;			//��ǰʱ�䵽����
$arr = array('Version'=>$version,
        'AccountID' => $accountID,      
        'ServiceName' => $serviceName,
        'ReqTime' => $reqTime
);
$sort_array  = arg_sort($arr);
$arg = concat_string($sort_array);
$digitalSign = md5($arg.$accountKey); //����ǩ��

//body�е��������
$clientIp = "127.0.0.1";
$cityId = 321;

//��$xml_data�ַ����е�param1�ڵ���ȥ�����ɿ����ٴ��������صĴ�����Ϣ��ʾ
$xml_data = '<?xml version="1.0" encoding="utf-8"?>
<request>
  <header>
    <version>'.$version.'</version>
    <accountID>'.$accountID.'</accountID>   
    <serviceName>'.$serviceName.'</serviceName>
    <digitalSign>'.$digitalSign.'</digitalSign>
    <reqTime>'.$reqTime.'</reqTime>
  </header>
  <body>
    <clientIp>'.$clientIp.'</clientIp>
    <cityId>'.$cityId.'</cityId>
  </body>
</request>';

/*************************************************************
 * ��һ�д��������л������ַ������ã������Ƿ�����
 *************************************************************/
//$xml_data = charset_encode($xml_data,'GBK','UTF-8');

$header = array();
$header[] = "Content-type: text/xml";	//����content-typeΪxml
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $server_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
$response = curl_exec($ch);
if(curl_errno($ch))
{
	print curl_error($ch);
}
curl_close($ch);

//print_r($response);

/*************************************************************
 * ��һ�д��������л������ַ������ã������Ƿ�����
 *************************************************************/
//$response = charset_decode($response,'UTF-8','GBK');

header("Content-type: text/xml");
echo $response;
?>
