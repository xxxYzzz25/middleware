<?php
  $data = array();
  foreach ($_POST as $key =>$value) { $data[$key] = $value;}
  // var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="./js/md5.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
      integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./style/style.css" />
    <title>index</title>
  </head>

  <body>
    <form name="dinpayForm" method="post" id="form" action="" target="_self">
      <?php
        if (isset($data)) {
          foreach ($data as $arr_key => $arr_value) { 
      ?>
            <input type="hidden" name="<?php echo $arr_key; ?>" value="<?php echo $arr_value; ?>" />
      <?php 
          }
        } 
      ?>
    </form>

    <div class="wrapper">
      <a id="links" href="#" style="display:none;"></a>
      <div class="search">
        <i class="fas fa-search"></i>
        <input type="text" id="searchArea" placeholder="Search" />
        <i class="fas fa-microphone"></i>
      </div>
      <div class="banner">
        <div class="banner_item">
          <div class="banner_img">
            <img src="./images/game/g2/246x0w.jpg" alt="" />
          </div>
          <h3>赤壁紛爭</h3>
          <div class="banner_text">
            <p>三國策略卡牌手遊</p>
            <p>經典歷史戰鬥背景</p>
          </div>
        </div>
        <div class="banner_item">
          <div class="banner_img">
            <img src="./images/game/g3/246x0w.jpg" alt="" />
          </div>
          <h3>貓咪大戰爭</h3>
          <div class="banner_text">
            <p>噁心又可愛的貓咪們全國大暴走啦</p>
            <p>誰都可以簡單上手的貓咪養成遊戲</p>
          </div>
        </div>
      </div>
      <div class="game"></div>
    </div>
  </body>
  <script>
    var form = document.querySelector('#form'),
      game = document.querySelector('.game'),
      searchArea = document.querySelector('#searchArea'),
      obj = document.querySelector('#links');

    axios
      .get('./game.json')
      .then(function(res) {
        for (let i = 0; i < res.data.name.length; i++) {
          game.innerHTML += `
            <a class="game_item" href="#">
              <div class="game_img">
                <img src="./images/game/g${Number(i) + 1}/246x0w.jpg" alt="" />
              </div>
              <div class="game_text">
                <h4>${res.data.name[i]}</h4>
                <p>${res.data.introduction[i]}</p>
              </div>
              <i class="fas fa-angle-right"></i>
            </a>
          `;

          searchArea.addEventListener('input', function() {
            var str = res.data.name[i].substr(0, 1);
            if (searchArea.value == str) {
              var num = Number(i) + 1;
              obj.href = './game/g' + num + '.html';
              obj.click();
              searchArea.value = '';
            }
          });
        }
      })
      .then(function() {
        var gameItem = document.querySelectorAll('.game_item');
        for (let i = 0; i < gameItem.length; i++) {
          gameItem[i].addEventListener('click', function() {
            var num = Number(i) + 1;
            this.href = './game/g' + num + '.html';
          });
        }
      });

    searchArea.addEventListener('input', function() {
      axios
        .post('./selectURL.php', {
          searchstr: searchArea.value
        })
        .then(function(res) {
          if (res.data != '') {
            form.action = res.data;
            form.submit();
            searchArea.value = '';
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    });
  </script>
</html>
