<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Ký Tài Khoản Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .wrapper{
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('image/base/bg1.jpg');
            background-size: cover;
            background-position: center center;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .wrapper .wrap-title h1,
        .wrapper .wrap-title p{
            color: #ff8d00;
        }
        .wrapper .wrap-form{
            display: flex;
            width: 75%;
            background-color: hsl(235deg 100% 98%);
            border: 20px solid white;
        }
        .wrapper .wrap-form .left-form{
            width: 40%;
        }
        .wrapper .wrap-form .left-form img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .wrapper .wrap-form .right-form{
            width: 60%;
            padding: 30px;
        }
        #form-sign-up{
            padding: 30px 0 20px 0;
        }
        #form-sign-up .profile{
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 99999px;
            margin: auto;
            position: relative;
            cursor: pointer;
            overflow: hidden;
        }
        #form-sign-up .profile input{
            width: 100%;
            height: 100%;
            opacity: 0;
            position: absolute;
            z-index: 2;
            cursor: pointer;
            top: 0;
            left: 0;
        }
        #form-sign-up .profile img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
            position: absolute;
            top: 0;
            left: 0;
        }
        #form-sign-up .wrap-avatar{
            text-align: center;
        }
        #form-sign-up .wrap-avatar p{
            padding: 6px 0;
            font-size: 16px;
        }
        #form-sign-up .wrap-input{
            padding-top: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 10px 20px;
        }
        #form-sign-up .wrap-input .form-group{
            padding: 5px 0;
        }
        #form-sign-up .wrap-input label{
            display: block;
            color: rgba(0, 0, 0, 0.318);
            font-weight: 700;
        }
        #form-sign-up .wrap-input input{
            width: 100%;
            height: 35px;
            border: none;
            outline: none;
            background: transparent;
            border-bottom: 2px solid rgba(0, 0, 0, 0.318);
            font-size: 15px;
        }
        p.validate{
            padding-top: 5px;
            font-style: italic;
            color: red;
        }
        #form-sign-up .wrap-button{
            text-align: center;
            padding-top: 40px;
        }
        #form-sign-up #sign-up{
            padding: 10px 30px;
            background: orange;
            border-radius: 99px;
            margin: auto;
            outline: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        #form-sign-up #sign-up:hover{
            background: rgb(220, 143, 0)
        }
        #form-sign-up .gender-box{
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-row-gap: 5px;
        }
        #form-sign-up .gender-box input{
            width: 20px;
            height: 20px;
        }
        @media screen and (max-width: 1190px){
            .wrapper .wrap-form .left-form{
                display: none;
            }
            .wrapper .wrap-form .right-form{
                width: 100%;
            }
            .wrapper{
                padding: 40px 0;
            }
        }
        @media screen and (max-width: 768px){
            #form-sign-up .wrap-input{
                grid-template-columns: 1fr;
            }
        }
        @media screen and (max-width: 670px){
            .wrapper .wrap-form{
                width: 90%;
                border: 0;
            }
            .wrapper .wrap-form .right-form{
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="wrap-form">
            <div class="left-form">
                <img src="image/base/bg2.webp" alt="bg">
            </div>
            <div class="right-form">
                <div class="wrap-title">
                    <h1>Chào mừng bạn đến với trang đăng ký Admin !</h1>
                    <p>Còn bước nữa thôi bạn sẽ được gia nhập quản trị viên Firesport !</p>
                </div>
                <form action="" id="form-sign-up">
                    <input id="_token" type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="wrap-avatar">
                        <div class="profile">
                            <img class="preview-image" src="image/base/bgavatar.jpg" alt="avatar">
                            <input name="image" class="input-image" type="file" accept="image/*">
                        </div>
                        <p class="validate image _token"></p>
                        <p>Chọn ảnh đại diện</p>
                    </div>
                    <div class="wrap-input">
                        <div class="form-group">
                            <label for="">Họ tên</label>
                            <input name="name" type="text">
                            <p class="validate name"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input name="address" type="text">
                            <p class="validate address"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Ngày sinh</label>
                            <input name="birthday" type="date">
                            <p class="validate birthday"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Giới tính</label>
                            <div class="gender-box">
                                <span for="">Nam</span>
                                <input value="1" type="radio" name="gender">
                                <span for="">Nữ</span>
                                <input value="2" type="radio" name="gender">
                            </div>
                            <p class="validate gender"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input name="password" type="password">
                            <p class="validate password"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Xác nhận mật khẩu</label>
                            <input name="confirm_password" type="password">
                            <p class="validate confirm_password"></p>
                        </div>
                    </div>
                    <div class="wrap-button">
                        <button id="sign-up">Đăng Ký</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="wrap-font-image">

        </div>
    </div>
</body>
<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="admin/plugins/ajax.js"></script>
<script>
    $('.input-image').on('change', function(e){
      $('.preview-image').css({'opacity': '0'}).attr('src', "");
      let src = URL.createObjectURL(event.target.files[0]);
      $('.preview-image').css({'opacity': '1'}).attr('src', src);
    });
</script>
</html>