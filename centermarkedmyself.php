<!doctype html>
<html lang="ja">
<head>
  <meta charset = "utf-8">
  <title>センター自己採点</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="SetBackground">
	<center><h1>センター自己採点1日目</h1></center>
  </div>
  <br>
  <p>センター試験1日目、お疲れ様です。自己採点するサイトを作ったので利用してください。</p>
　<p>今回、解答は<a hlef="">こちら(現在未定、信憑性の高いサイトが更新されたら掲載します)</a>のサイトを参考にしています。この場を借りてお礼申し上げます。</p>
  <p>以下の順番で選択してください</p>
　<p>① : 科目を選択した後、表示される表に、各設問ごと自分が回答した番号を選択して下さい(初期は「未選択」にチェックが入っています)</p>
  <p>② : 全てチェックしたのを確認した上で、採点ボタンを押すと採点されます。</p>
  <h4>※最初から[解答をすべて入力してください]と出ているのは仕様です</h4>
<hr>
<form method="post" action="centermarkedmyself.php">
	①：　<select name="subjects" required>
  		<option value="">科目を選択してください</option>
  		<option value="日本史B">日本史B</option>
　		<option value="政治・経済">政治・経済</option>
　		<option value="国語">国語</option>
  		<option value="英語">英語</option>
  		<option value="リスニング">リスニング</option>
	</select>
	<input type="submit" name = "a" value="科目選択">
</form>
<hr>
<p>本当にすべて解答を入力しましたか？大丈夫でしたらOKをクリックして採点ボタンを押してください。下に採点結果が表示されます。</p>
<form method="post" action="centermarkedmyself.php">
	②　：<input type='radio' name ='OKorNO' value='OK'>OK
	<input type='radio' name ='OKorNO' value='NO' checked>NO
	<input type="submit" name = "b" value="採点">
<hr>
<?php
error_reporting(0);
if(isset($_POST["a"])){

	// 有効期限1日
	session_cache_expire(60 * 24);

	session_start();

	if($_POST["subjects"]=='日本史B'){
		$_SESSION['subject'] = $_POST["subjects"];
		$questionNum = array(6,6,6,6,4,8);
		$_SESSION['allQuestion'] = 36;
		$bigQuestion = 6;
		$_SESSION['answer'] = array();
		$_SESSION['points'] = array();
	}else if($_POST["subjects"]=='政治・経済'){
		$_SESSION['subject'] = $_POST["subjects"];
		$questionNum = array(5,7,7,8,5,5);
		$_SESSION['allQuestion'] = 37;
		$bigQuestion = 6;
		$_SESSION['answer'] = array();
		$_SESSION['points'] = array();
	}else if($_POST["subjects"]=='国語'){
		$_SESSION['subject'] = $_POST["subjects"];
		$questionNum = array(11,9,8,8);
		$_SESSION['allQuestion'] = 36;
		$bigQuestion = 4;
		$_SESSION['answer'] = array();
		$_SESSION['points'] = array(2,2,2,2,2,8,8,8,8,4,4,3,3,7,8,8,8,5,5,5,5,5,5,7,7,8,8,4,4,7,7,6,7,7,8);
	}else if($_POST["subjects"]=='英語'){
		$_SESSION['subject'] = $_POST["subjects"];
		$questionNum = array(7,18,6,8,5,10);
		$_SESSION['allQuestion'] = 54;
		$bigQuestion = 6;
		$_SESSION['answer'] = array();
		$_SESSION['points'] = array(2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,4,4,4,5,5,5,5,5,5,6,6,6,5,5,5,5,5,5,5,5,6,6,6,6,6,6,6,6,6,6,0,0,0,6);
	}else if($_POST["subjects"]=='リスニング'){
		$_SESSION['subject'] = $_POST["subjects"];
		$questionNum = array(6,7,6,6);
		$_SESSION['allQuestion'] = 25;
		$bigQuestion = 4;
		$_SESSION['answer'] = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
		$_SESSION['points'] = array(2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2);
	}
	$tmp = 1;
	$html = "<table>";
	$html .= "<tr><th colspan='3'>{$_POST['subjects']}</th></tr>";
	$html .= "<tr>";
	$html .= "<th>番号</th>";
	$html .= "<th colspan='2'>解答</th>";
	$html .= "</tr>";
	$html .= "<tr>";
	for($i = 1 ; $i <= $bigQuestion ; $i++){
		$html .= "<th rowspan= '{$questionNum[$i-1]}'>[{$i}]</th>";
		for($j=1;$j<=$questionNum[$i-1];$j++){
			$html .= "<th>{$tmp}</th>";
			$html .= "<td>";
			for($k = 1; $k <= 9; $k++){
				$html .= "<input type='radio' name ='{$tmp}' value='{$k}'>{$k}";
			}
			$html .= "<input type='radio' name ='{$tmp}' value='0' checked>未選択";
			$tmp++;
			$html .= "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
		}
	}
	$html .= "</table>";
	echo($html);
}
if(isset($_POST["OKorNO"])){
	session_start();
	$subjects = $_SESSION['subject'];
	$answer = $_SESSION['answer'];
	$points = $_SESSION['points'];
	$myPoint = 0;
	if($_POST["OKorNO"]=='OK'){
		for($l = 1; $l <= $_SESSION['allQuestion']; $l++){
			if($_POST[$l]==$answer[$l-1]){
				$myPoint += $points[$l-1];
			}
		}
		$html = "<h2>貴方の{$subjects}の点数は{$myPoint}点です。</h2>";
		echo($html);
		session_destroy();
	}else{
		echo('解答をすべて入力してください。');
		session_destroy();
	}
}
?>
</form>
<footer>Copyright &copy; 2020, soundofhorizon, All right reserved.</footer>
</body>
</html>
