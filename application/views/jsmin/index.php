<header>
	<h1>ลดขนาดไฟล์ Javascript ด้วย JS Minifier</h1>
    <hr />
	<p class="content">JS Minifier เป็นสคริปสำหรับย่อขนาด <b>บีบอัดไฟล์</b> ของ javascript ให้มีขนาดเล็กลง เพื่อให้หน้าเว็บที่เขียนขึ้นมีขนาดไฟล์ที่เล็กลง และส่งผลให้หน้าเว็บโหลดได้เร็วขึ้น ไฟล์ javascript บางไฟล์อาจจะสามารถ บีบอัดไฟล์ ลดขนาดลงได้ถึง 40% เลยทีเดียว หากไฟล์ javascript สามารถลดขนาดลงได้ 50K หากเว็บของท่านมีผู้ชม 1000 คน ก็จะสามารถลด แบนวิดของเว็บได้ถึง 50MB เลยทีเดียว การ <b>ลดขนาดไฟล์</b> มีความสำคัญมา ยิ่งหากเว็บของคุณมีคนเช้าชมมากๆ ยิ่งต้องใส่ใจในรายละเอียดและเทคนิคการทำเว็บเพิ่มขึ้น เพราะประสิทธิภาพของเว็บไซต์ของคุณเอง ^^</p>
</header>
<article>
	<h2>ข้อความคอมเม้นส่วนหัว</h2>
	<textarea id="comment" name="comment" class="span12"></textarea>
	<h2>โค้ดไฟล์ต้นฉบับ</h2>
	<textarea id="input" name="input" class="span12" rows="10"></textarea>
	<br/><br/>
		ระดับการบีบอัด:&nbsp;
		<select id="level">
			<option value="1">เหมือนต้นฉบับที่สุด</option>
			<option value="2" selected="selected">ขึ้นบรรทัดใหม่ตามฟังชั่น</option>
			<option value="3">ย่อให้เล็กที่สุด</option>
		</select>
		&nbsp;&nbsp;
		<input id="go" type="submit" value="บีบอัด" onclick="go();return false;" class="btn" />
		&nbsp;&nbsp;
		<input type="submit" value="ล้าง" onclick="bw();return false;" class="btn" /><br/><br/>
		<ul>
        	<li><b>เหมือนต้นฉบับที่สุด</b>: เหมือนต้นฉบับ ตัดช่องว่างระหว่างตัวหนังสือออก</li>
        	<li><b>ขึ้นบรรทัดใหม่ตามฟังชั่น</b>: ตัดคอมเม้น เลื่อนโค้ดมาชิดกันและตัดช่องว่างระหว่างตัวหนังสือออก</li>
        	<li><b>ย่อให้เล็กที่สุด</b>: บีบย่อโค้ดโปรแกรมให้มีขนาดเล็กที่สุดเท่าที่จะเป็นไปได้</li>
        </ul>
	<h2 id="outputtitle">โค้ดไฟล์บีบอัดแล้ว</h2>
	<textarea id="output" name="output" class="span12" rows="10"></textarea>
	<h2 id="statstitle">สถานะ</h2>
	<div id="stats">ไฟล์ต้นฉบับ : <input id="oldsize" class="span2"></span> ไฟล์บีบอัดแล้ว : <input id="newsize" class="span2"></span> อัตราส่วน : <input id="ratio" class="span2"></span></div>
</article>
<script type="text/javascript">
function $(i){return document.getElementById(i);}
function go() {
	$('output').value = jsmin($('comment').value, $('input').value, $('level').value);
	$('outputtitle').style.display = $('output').style.display = $('statstitle').style.display = $('stats').style.display = 'block';
	$('oldsize').value = jsmin.oldSize;
	$('newsize').value = jsmin.newSize;
	$('ratio').value = (Math.round(jsmin.newSize / jsmin.oldSize * 1000) / 10) + '%';
}
function bw() {
	$('comment').value = $('input').value = $('output').value = '';
	$('outputtitle').style.display = $('output').style.display = $('statstitle').style.display = $('stats').style.display = 'none';
}
</script>