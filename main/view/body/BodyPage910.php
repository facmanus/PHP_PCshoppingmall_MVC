<script language="JavaScript">
    function check(theForm){
        if(!(theForm.id.value)){
            alert("아이디 입력해주세요");
            theForm.id.focus();
            return(false);
        }
        if else(!(theForm.passwd.value)){
            alert("비밀번호를 올바르게 입력해주세요");
            theForm.id.focus();
            return(false);
        }

        return(true);
    }
</script>
<?php
// 회원정보 수정과 회원가입 코딩
  if($action==914){
    $user_member_id=$_SESSION['update_member_id'];
    $user_id=$_SESSION['update_id'];
    $name=$_SESSION['update_name'];
    $passwd=$_SESSION['update_passwd'];
    $gender=$_SESSION['update_gender'];
    $phone=$_SESSION['update_phone'];
    $address=$_SESSION['update_address'];
    $movie=$_SESSION['update_movie'];
    $book=$_SESSION['update_book'];
    $shop=$_SESSION['update_shop'];
    $sport=$_SESSION['update_sport'];
    $intro=$_SESSION['update_intro'];
    $nick=$_SESSION['update_nick'];

  }
  if($action==914){
    echo"<h5>▶ 회원 정보 수정 ◀</h5>";
  }
  else{
    echo"<h5>▶ 회원가입 ◀</h5>";
  }
?>

<form name="mem_form" method="post" action="../../main/controller/MainCTL.php<?php if($action==910)echo"?action=911"; else echo"?action=915";?>" onsubmit="return check(this)">
<input type="hidden" name="title" value="회원 가입 양식">
<table width="550" cellspacing="1" cellpadding="4"  style="font-size: 11">
    <tr>
      <td align="right">* 아이디 :</td>
      <td><input type="text" size="15" maxlength="12" name="id" placeholder="아이디 입력해주세요." <?php if($action==914) echo("value=".$user_id."(수정불가) disabled");?>></td>
    </tr>
    <tr>
      <td align="right" > * 이름 :</td>
      <td><input type="text" size="15" maxlength="12" name="name" placeholder="이름을 입력해주세요." <?php if($action==914) echo("value=".$name."(수정불가) disabled");?>></td>
    </tr>
    <tr>
      <td align="right" > * 닉네임 :</td>
      <td><input type="text" size="15" maxlength="12" name="nick" placeholder="닉네임을 입력해주세요." <?php if($action==914) echo("value=".$nick);?>></td>
    </tr>
    <tr>
           <td align="right"> * 비밀번호 :</td>
           <td><input type="password" size="15" maxlength="10" name="passwd" placeholder="비밀번호 입력해주세요." <?php if($action==914) echo("value=".$passwd);?>></td>
         </tr>
     <tr>
           <td align="right"> * 비밀번호 확인 :</td>
           <td><input type="password" size="15" maxlength="12" name="passwd_confirm" placeholder="비밀번호를 확인해주세요."<?php if($action==914) echo("value=".$passwd);?>></td>
         </tr>
     <tr>
           <td align="right">성별 :</td>
           <td><input type="radio" name="gender" value="M" <?php if($action==914&&$gender=="M") echo"CHECKED";?>>남
                   <input type="radio" name="gender" value="F" <?php if($action==914&&$gender=="F") echo"CHECKED";?>>여</td>
         </tr>
     <tr>
           <td align="right">휴대전화 :</td>
           <td><select name="phone1">
                     <option <?php if($action==914) echo("value=0".substr($phone,0,2)); else echo"010"; ?>><?php if($action==914) echo("0".substr($phone,0,2)); else echo"010"; ?></option>
                     <option value="011">011</option>
                     <option value="017">017</option>
                     </select> -
               <input type="text" size="4" name="phone2" maxlength="4" <?php if($action==914) echo("value=".substr($phone,2,4));?>> -
               <input type="text" size="4" name="phone3" maxlength="4" <?php if($action==914) echo("value=".substr($phone,6,4));?>></td>
         </tr>
     <tr>
           <td align="right">주 소 :</td>
           <td><input type="text" size="50" name="address" <?php if($action==914) echo("value=".$address);?>></td>
         </tr>
     <tr>
           <td align="right">취 미 :</td>
           <td>
               <input type="checkbox" name="movie" value="yes" <?php if($action==914&&$movie=="O") echo"CHECKED";?>>영화감상 &nbsp;
               <input type="checkbox" name="book" value="yes" <?php if($action==914&&$book=="O") echo"CHECKED";?>>독서 &nbsp;
               <input type="checkbox" name="shop" value="yes" <?php if($action==914&&$shop=="O") echo"CHECKED";?>>쇼핑 &nbsp;
               <input type="checkbox" name="sport" value="yes" <?php if($action==914&&$sport=="O") echo"CHECKED";?>>운동
               </td>
         </tr>
     <tr>
           <td align="right">자기소개 :</td>
           <td><textarea name="intro" rows="5" cols="60"><?php if($action==914) echo($intro);?></textarea></td>
         </tr>
     </table>
     <br>
     <table border="0" width="640">
         <tr><td align="center">
                  <?php
                    if($action==914){
                      echo"<input type='hidden' name='member_id' value={$user_member_id}>";
                      echo"
                        
                        <input type='submit' value='수정'>
                      ";
                    }
                    else{
                      echo"
                        <input type='submit' value='확인'>
                        <input type='reset' value='다시작성'>
                      ";
                    }
                  ?>
                 </td>
             </tr>
         </table>
     </form>
 </body>
 </html>
