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
　<p>今回、解答は<a hlef="https://www.toshin.com/center/index.html">こちら</a>のサイトを参考にしています。この場を借りてお礼申し上げます。</p>
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
<p>本当にすべて解答を入力しましたか？大丈夫でしたらOKをクリックして採点ボタンを押してください。下に採点結果が表示されます。(入力情報はセキュリティ上破棄されます。)</p>
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
		$_SESSION['questionNum'] = array(6,6,6,6,4,8);
		$_SESSION['allQuestion'] = 36;
		$_SESSION['bigQuestion'] = 6;
		$_SESSION['answer'] = array(1,1,4,5,3,3,4,1,1,3,2,1,2,4,2,2,2,1,1,5,3,2,4,3,3,4,4,2,4,2,1,3,2,4,1,1);
		$_SESSION['points'] = array(2,3,2,3,3,3,3,2,3,3,2,3,3,3,2,2,3,3,2,3,3,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3);
	}else if($_POST["subjects"]=='政治・経済'){
		$_SESSION['subject'] = $_POST["subjects"];
		$_SESSION['questionNum'] = array(5,7,7,8,5,5);
		$_SESSION['allQuestion'] = 37;
		$_SESSION['bigQuestion'] = 6;
		$_SESSION['answer'] = array(4,4,3,3,4,3,2,4,4,1,4,2,3,1,1,2,2,3,1,2,4,4,2,4,3,3,1,3,1,6,2,3,2,4,1,4,3);
		$_SESSION['points'] = array(3,3,3,2,3,2,3,3,2,2,3,3,2,3,3,3,2,2,3,2,2,3,3,3,3,3,3,2,3,3,3,3,3,3,3,3,2);
	}else if($_POST["subjects"]=='国語'){
		$_SESSION['subject'] = $_POST["subjects"];
		$_SESSION['questionNum'] = array(11,9,8,7);
		$_SESSION['allQuestion'] = 36;
		$_SESSION['bigQuestion'] = 4;
		$_SESSION['answer'] = array(5,1,1,4,5,2,3,2,2,1,4,1,1,4,4,2,5,2,3,6,3,2,4,1,3,5,2,5,5,3,2,2,1,5,4);
		$_SESSION['points'] = array(2,2,2,2,2,8,8,8,8,4,4,3,3,3,7,8,8,8,5,5,5,5,5,6,7,7,7,8,4,4,8,8,8,9,9);//漢文部分配点変更
	}else if($_POST["subjects"]=='英語'){
		$_SESSION['subject'] = $_POST["subjects"];
		$_SESSION['questionNum'] = array(7,19,6,8,5,9);
		$_SESSION['allQuestion'] = 54;
		$_SESSION['bigQuestion'] = 6;
		$_SESSION['answer'] = array(2,3,4,2,1,1,2,3,1,3,3,1,1,1,4,2,1,4,2,4,3,5,2,3,1,3,2,2,2,3,3,4,4,4,2,4,1,1,2,4,1,4,4,2,2,1,3,2,4,2,2,4,3,1);
		$_SESSION['points'] = array(2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,4,4,4,5,5,5,5,5,5,6,6,6,5,5,5,5,5,5,5,5,6,6,6,6,6,6,6,6,6,6,6);
	}else if($_POST["subjects"]=='リスニング'){
		$_SESSION['subject'] = $_POST["subjects"];
		$_SESSION['questionNum'] = array(6,7,6,6);
		$_SESSION['allQuestion'] = 25;
		$_SESSION['bigQuestion'] = 4;
		$_SESSION['answer'] = array(1,3,2,4,3,3,3,2,3,3,3,1,2,3,2,2,4,2,1,3,1,3,4,2,1);
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
	for($i = 1 ; $i <= $_SESSION['bigQuestion'] ; $i++){
		$html .= "<th rowspan= '{$_SESSION['questionNum'][$i-1]}'>[{$i}]</th>";
		for($j=1;$j<=$_SESSION['questionNum'][$i-1];$j++){
			$html .= "<th>{$tmp}</th>";
			$html .= "<td>";
			for($k = 1; $k <= 9; $k++){
				$html .= "<input type='radio' name ='{$tmp}' value='{$k}'>{$k}";
			}
			$html .= "<input type='radio' name ='{$tmp}' value='None' checked>未選択";
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
			if($subjects = "英語"){
				if($l<=17){
					if($_POST[$l]==$answer[$l-1]){
						$myPoint += $points[$l-1];
					}
				}else if($l==18){
					if($_POST[18]==$answer[17]&&$_POST[19]==$answer[18]){
						$myPoint += $points[17];
					}
					$l = $l + 1;
				}else if($l==20){
					if($_POST[20]==$answer[19]&&$_POST[21]==$answer[20]){
						$myPoint += $points[18];
					}
					$l = $l + 1 ;
				}else if($l==22){
					if($_POST[22]==$answer[21]&&$_POST[23]==$answer[22]){
						$myPoint += $points[19];
					}
					$l = $l + 1 ;
				}else if(24<=$l&&$l<=50){
					if($_POST[$l]==$answer[$l-1]){
						$myPoint += $points[$l-4];
					}
				}else if($l==51){
					if($_POST[51]==$answer[50]&&$_POST[52]==$answer[51]&&$_POST[53]==$answer[52]&&$_POST[54]==$answer[53]){
						$myPoint += $points[47];
					}
				}
			}else{
				if($_POST[$l]==$answer[$l-1]){
					$myPoint += $points[$l-1];
				}
			}
		}
		$html = "<h2><center>貴方の{$subjects}の点数は {$myPoint} 点です。</center></h2>";
		$tmp = 1;
		$html .= "<center>採点詳細結果(未選択の場合[None]になってます)</center>";
		$html .= "<table>";
		$html .= "<tr><th colspan='6'>{$subjects}</th></tr>";
		$html .= "<tr>";
		$html .= "<th colspan='2'>番号</th>";
		$html .= "<th>あなたの解答</th>";
		$html .= "<th>正答</th>";
		$html .= "<th>正誤</th>";
		$html .= "<th>配点</th>";
		$html .= "</tr>";
		$html .= "<tr>";
		for($i = 1 ; $i <= $_SESSION['bigQuestion'] ; $i++){
			$html .= "<th rowspan= '{$_SESSION['questionNum'][$i-1]}'>[{$i}]</th>";
			for($j=1;$j<=$_SESSION['questionNum'][$i-1];$j++){
				$html .= "<th>{$tmp}</th>";
				$html .= "<td><center>{$_POST[$tmp]}</center></td>";
				$html .= "<th>{$answer[$tmp-1]}</th>";
				if($_POST[$tmp]==$answer[$tmp-1]){
					$html .= "<th>〇</th>";
				}else{
					$html .= "<th>×</th>";
				}
				if($subjects=="英語"){
					if($tmp==18){
						$html .= "<td rowspan='2'><center>{$points[17]}</center></td>";
					}else if($tmp==20){
						$html .= "<td rowspan='2'><center>{$points[18]}</center></td>";						
					}else if($tmp==22){
						$html .= "<td rowspan='2'><center>{$points[19]}</center></td>";
					}else if($tmp==19||$tmp==21||$tmp==23){
						
					}else if(24<=$tmp&&$tmp<=50){
						$html .= "<td><center>{$points[$tmp-4]}</center></td>";
					}else if($tmp==51){
						$html .= "<td rowspan='4'><center>{$points[47]}</center></td>";
					}else if(52<=$tmp&&$tmp<=54){

					}else{
						$html .= "<td><center>{$points[$tmp-1]}</center></td>";
					}
				}else{
					$html .= "<td><center>{$points[$tmp-1]}</center></td>";
				}
				$tmp++;
				$html .= "</td>";
				$html .= "</tr>";
				$html .= "<tr>";
			}
		}
		$html .= "</table>";
		echo($html);
		session_destroy();
	}else{
		echo('解答をすべて入力してください。');
		session_destroy();
	}
}
?>
</form>
<footer>Copyright &copy; 2020, soundofhorizon</footer>
</body>
</html>
