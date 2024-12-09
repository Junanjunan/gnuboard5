<?php
include_once('./_common.php');
?>

<div class="logo_area">
    <img src="/img/logo.png" alt="로고">
</div>

<h2>회원탈퇴 안내</h2>

<div>모바일 어플리케이션 그누보드 회원탈퇴 안내</div>

<div class="member_leave_form">
    <form name="member_leave" action="./member_leave.php" method="post" onsubmit="return member_leave_check();">
    <div class="form_01">
        <ul>
            <li>
                <label for="mb_id">아이디</label>
                <input type="text" name="mb_id" id="mb_id" required class="frm_input required">
            </li>
            <li>
                <label for="mb_password">비밀번호</label>
                <input type="password" name="mb_password" id="mb_password" required class="frm_input required">
            </li>
        </ul>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="회원탈퇴" class="btn_submit">
        <a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
    </div>
    </form>
</div>

<script>
function member_leave_check() {
    if (confirm("정말 회원탈퇴 하시겠습니까?") == false) {
        return false;
    }
    return true;
}
</script>
