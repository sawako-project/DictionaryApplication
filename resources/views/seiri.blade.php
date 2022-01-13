<style>
@charset "UTF-8";

/* 全般 */

li {
    list-style: none;
}

a {
    text-decoration: none!important;
}

a:hover {
    cursor: pointer!important;
}

a,
a:visited,
a:hover,
a:active {
    color: inherit;
}

#app {
    background-color: rgb(250, 242, 232);/** #f1bbc2 rgb(252, 225, 252); rgb(248, 248, 239); rgb(234,209,220)*/
    width: 100%;
    /* margin: o auto; */
    position: relative;/*❗️*/
    z-index:1;/*❗️*/
}

/* .heading {
  margin-bottom: 10px;
} */

.heading h2 {
    /* font-weight: bold;  */
    font-family: 'Kiwi Maru', serif!important;
}

.heading .under {
    border-bottom: dotted 3px #cda45e!important;/* rgb(131, 128, 128) */
}

/* nav */
#main-nav {
    transition: all 0.7s;
    background-color: rgba(0,0,0,0.0);
    height:100px;
}

.scrolled #main-nav {
    background-color: rgba(0,0,0,0.5);
    height:50px;
}

.page-navbar {
    height: 50px;
}

.page-navbar #main-nav {
    background-color: rgba(0,0,0,0.5);
    height:50px;
}

#main-nav a {
    color: white;
}

#main-nav a:hover {
    color:#cda45e;
}

.navbar-brand {
    font-size: 200px;
    font-family: 'Ephesis', cursive;
    /*font-family: 'Kaushan Script', cursive;*/
    overflow: hidden;
}

.nav-item {
    padding: 0 5px;
    /* font-family: 'M PLUS Rounded 1c', sans-serif; */
    font-family: 'Kiwi Maru', serif; 
}

/*==768px以下の形状*/

@media screen and (max-width:990px){

    .navbar-toggler {
        overflow:visible;
    }

    .navbar-collapse {
        background-color: rgba(0,0,0,0.5);
    }
}

/*navber dropdown*/

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-menu a {
    float: none;
    color: black!important;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-menu a:hover {
    background-color: #ddd;
    color:#cda45e!important;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

/*  */
footer {
    /* font-family: 'M PLUS Rounded 1c', sans-serif; */
    font-family: 'Kiwi Maru', serif;
}

/* scroll top */
.back-to-top {  
    width: 44px;
    height: 44px;

    position: fixed;
    right: 15px;
    bottom: 15px;
    z-index: 1000;
    
    border-radius: 50px;
    border: 2px solid #cda45e;

    display:flex;
    justify-content: center;
    align-items: center;
    
    transition: 0.4s;
    opacity: 0;
}

.back-to-top i {
    font-size: 14px;
    color: #cda45e;
    line-height: 0;
    /* border-bottom: none!important; */
}

.scrolled .back-to-top {
    opacity: 1;
}

/* card */
.base-card,.pop-card {/*.card*/
    font-family: 'Kiwi Maru', serif;
    overflow: hidden;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 10px!important;
    /* border-color:#cda45e!important; */
    /*  */
    position:relative;
    /* box-shadow:none; */
    transition:box-shadow 0.3s, transform 0.3s;
    /*  */
}

.pop-card:active {/*.pop-card|.card*/
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px;
    /*rgba(0, 0, 0, 0.3) 0px 19px 38px; 0 2px 5px rgba(0, 0, 0, 0.3) rgba(0, 0, 0, 0.35) 0px 5px 15px*/
    transform:scale(1.02);
    border-color:#cda45e!important;
}

.pop-card:hover {/*.pop-card|.card*/
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px;
    transform:scale(1.02);
    /* border-color:#cda45e!important; */
    border-color:#cda45e!important;
}

/* .card:hover {
  box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px;
  transform:scale(1.02);
  border-color:#cda45e!important;
} */

/* card */

/* フォームのあれこれ */
.form-group {
    font-family: 'Kiwi Maru', serif;
    display: flex;
    justify-content: center
}

/* .form-group button {
  display: flex;
  justify-content: center
} */

.radio-list input {
    position: absolute;
    white-space: nowrap;
    width: 1px;
    height: 1px;
    overflow: hidden!important;
    border: 0;
    padding: 0;
    clip: rect(0 0 0 0);
    clip-path: inset(50%);
    margin: -1px;
}

.m-form-radio-name {
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    color: #666;/*  Rgb : rgb(102,102,102) 灰黒*/
}

.m-form-radio-name:before {
    content: "";
    display: inline-block;
    width: 1em;
    height: 1em;
    border: 1px solid #ccc;/*  rgb(204,204,204) 灰 */
    border-radius: 50%;
    margin-right: 4px;
    flex-shrink: 0;
}
.radio-list input:checked + .m-form-radio-name:before {
    border: 0.3em solid  rgb(205,164,94);/* rgb(33, 150, 243)青 rgb(255,181,46)*/
}

.radio-list input:checked + .m-form-radio-name {
    color:  rgb(205,164,94);/* rgb(33, 150, 243)青 rgb(255,181,46)*/
}

.radio-list input:focus + .m-form-radio-name {
    color:  rgb(205,164,94);/* rgb(33, 150, 243)青 rgb(255,181,46)*/
}

.radio-list input.focus-visible + .m-form-radio-name .m-form-radio-text {
    background: linear-gradient(transparent 90%, rgba(205,164,94, 0.3) 90%);/* rgba(33, 150, 243, 0.3)青 rgba(255,181,46, 0.3)*/
}

/* .check-list label{
display: block;
float: left;
width: 110px;
} */

/* .m-form-checkbox input { */
.check-list input {
    position: absolute;
    white-space: nowrap;
    width: 1px;
    height: 1px;
    overflow: hidden!important;
    border: 0;
    padding: 0;
    clip: rect(0 0 0 0);
    clip-path: inset(50%);
    margin: -1px;
}

.m-form-checkbox-name {
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    color: #666;/*  */
    position: relative;
}

.m-form-checkbox-name:before {
    content: "";
    display: inline-block;
    width: 1em;
    height: 1em;
    border: 1px solid #ccc;/*  */
    border-radius: 3px;
    margin-right: 6px;
    flex-shrink: 0;
}

.check-list input:checked + .m-form-checkbox-name:before {
    border: 1px solid rgb(205,164,94);/*rgb(255,181,46) rgb(33, 150, 243) #cda45e rgb(205,164,94)*/
    background-color: rgb(205,164,94);/* rgb(33, 150, 243) #cda45e rgb(205,164,94)*/
}

.check-list input:checked + .m-form-checkbox-name:after {
    content: "";
    position: absolute;
    border: solid #fff;/* 白 */
    border-width: 0 2px 2px 0;
    left: 0.3em;
    top: 0;
    bottom: 0;
    margin: auto;
    width: 0.4em;
    height: 0.6em;
    transform: translateY(-2px) rotate(45deg);
}

.check-list input:checked + .m-form-checkbox-name {
    color: rgb(205,164,94);/* rgb(33, 150, 243) #cda45e rgb(205,164,94)*/
}

.check-list input:focus-visible + .m-form-checkbox-name .m-form-checkbox-text {
    background: linear-gradient(transparent 90%, rgba(205,164,94, 0.3) 90%);/* rgba(33, 150, 243, 0.3) #cda45e rgb(205,164,94)*/
}

.check-list input.focus-visible + .m-form-checkbox-name .m-form-checkbox-text {
    background: linear-gradient(transparent 90%, rgba(205,164,94, 0.3) 90%);/* rgba(33, 150, 243, 0.3) #cda45e rgb(205,164,94)*/
}

.textarea-space textarea {
    height: 300px;
}

.m-form-textarea {
    display: block;
    width: 100%;
    padding: 4px 16px;
    border-radius: 4px;
    border: none;
    box-shadow: 0 0 0 1px #ccc inset;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    resize: vertical;
}

.m-form-textarea:focus {
    outline: 0;
    box-shadow: 0 0 0 2px rgb(33, 150, 243) inset;
}

.m-form-text {
    height: 2.4em;
    width: 100%;
    padding: 0 16px;
    border-radius: 4px;
    border: none;
    box-shadow: 0 0 0 1px #ccc inset;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

.m-form-text:focus {
    outline: 0;
    box-shadow: 0 0 0 2px rgb(33, 150, 243) inset;
}

/*  */
.form-group {
    margin: 10px 0;
}

.form-check {
    float: left;
    text-align: left;
}

.card-body a {
    text-decoration: underline!important;
}

/*  */
.item_box {
    border: 1px solid #f3f3f3;
    border-radius: 10px;
}

hr {
    color:#f3f3f3;
}

/* ページネント */
/* .pagination { */
  /*display: inline-block;*/
 /* } */
 
 /* .pagination .page-item {
   color: black;
   float: center;
   padding: 8px 16px;
   text-decoration: none;
   list-style: none;
 } */

/* _____________________________________ */

/* #search {
  border: 1px solid #333;
 } */

/*========= レイアウトのためのCSS ===============*/
/* body{
  background:#333;
}
p{
  text-align: center;
  margin: 20px 0;
  font-size:1.5rem;
  color: #fff;
} */

/* .phraseAboutSituationEvent label{
  display: block;
  float: left;
  width: 110px;
} */

/* _____________________________________ */

/* 個別 */

/*========= スクロールをすると下のエリアが上にかぶさるCSS ===============*/

#backgroundImg {
    /*backgroundScrollを全画面で見せる*/
    width:100%;
    height: 100vh;
    position: relative;/*❗️*/
}

#backgroundImg:before {
    /*backgroundScroll の疑似要素に背景画像を指定*/
    content:"";
    position:fixed;/*❗️*/
    top:0;
    left:0;
    z-index:-1;/*❗️*/
    width:100%;
    height: 100vh;
    /*背景画像設定*/
    background:url("../img/iStock-698734060.jpg") no-repeat center;
    /* or
    background-image: url("../img/calendar-gd50c90a80_1920.jpg") ; */
    /* ⭕️../img/calendar-gd50c90a80_1920.jpg
      ❌../public/img/calendar-gd50c90a80_1920.jpg */
    background-size:cover;
}

/*========= レイアウトのためのCSS ===============*/
  
#backgroundImg h1 {
    position: fixed;/*❗️*/
    top: 50%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
    color:whitesmoke;
    text-shadow: 0 0 15px #666;
    text-align: center;
    /* font-size: 100px; */
    font-family: 'Kiwi Maru', serif;
    /* z-index: 1; */
}

/* ❗️ */
#backgroundImg p {
    position: fixed;/*❗️*/
    top: 60%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
    /* color:#fff; */
    color: rgb(94, 91, 91);
    text-shadow: 0 0 15px #666;
    text-align: center;
    font-size: 20px;
    font-family: 'Kiwi Maru', serif;
    /* z-index: 1; */
}

/*========= 光りながら出現させるためのCSS ===============*/

.glowAnime span {
    opacity: 0;
}

/*アニメーションで透過を0から1に変化させtext-shadowをつける*/
.glowAnime.glow span { 
    animation:glow_anime_on 1s ease-out forwards; 
}

@keyframes glow_anime_on {

    0% { 
      opacity:0; 
      text-shadow: 0 0 0 #fff,0 0 0 #fff;
    }

    50% { 
      opacity:1;
      text-shadow: 0 0 10px #fff,0 0 15px #fff; 
    }

    100% { 
      opacity:1; 
      text-shadow: 0 0 0 #fff,0 0 0 #fff;
    }
}

.search-area {
    font-family: 'Kiwi Maru', serif;
    width: 30%!important;
    /* display: flex!important; */
    text-align: center;
    margin: 0 auto;
    /* margin-top: 50%; */
    position: fixed;/*❗️*/
    top: 55%;
    left: 35%;
    border-radius: 100px;
}

/* admin */
/* .table {
  font-family: 'Kiwi Maru', serif!important;
} */

/* phrase-list */
.phrase-list {
    line-height: 1.5;
}

.phrase-list dl {
    display: flex;
    flex-flow: row wrap;
    width: 100%;/** 70%*/
    margin: 0px auto;/** 50px*/
}

.phrase-list dt {
    flex-basis: 15%;
    padding: 20px;
    background-color: #f1f1f1;
      border-top: 1px solid #ccc;
    /* border-bottom: 1px solid #ccc; */
}

.phrase-list dd {
    flex-basis: 85%;
    padding: 20px;
    background-color: #fff;
      border-top: 1px solid #ccc;
      /* border-right: 1px solid #ddd; */
    /* border-bottom: 1px solid #ccc; */
}

/* .phrase-list dt:first-child {
 border-top: 1px solid #ccc;
   border-bottom: 1px solid #ccc;
}

.phrase-list dd:nth-child(2) {
 border-top: 1px solid #ccc;
   border-bottom: 1px solid #ccc;
} */

@media screen and (max-width: 990px) {/**768px 559px*/

    .phrase-list dl {
        flex-flow: column;
        width: 100%;
        padding: 0 20px;
        border: 0;
    }

    .phrase-list dt, .phrase-list dd {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .phrase-list dd:nth-child(2) {
        border-top: 0;
    }
}


/*  */
.tagify__tag>div::before {
    background-color:#e5e5e5;
}

/*  */
.eventForm {
    display: none;
}

/*  */
/* user-event-post */
/* .user-event-post .card {
  margin-top: 50px;
} */

/* .contact input,textarea{
  visibility: hidden;
} */
</style>