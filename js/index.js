const form = document.querySelector('#form'),
  game = document.querySelector('.game'),
  searchArea = document.querySelector('#searchArea'),
  obj = document.querySelector('#links'),
  microphone = document.querySelector('.fa-microphone');

if (microphone) {
  init();
  searchArea.addEventListener('keyup', e => {
    search(e);
  });
} else {
  toPush();
}

function init() {
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
}

function search(e) {
  if (e.keyCode == 13) {
    location.href = `../push.html?${searchArea.value}`;
  }
}

const image = document.querySelector('.top .image'),
  name = document.querySelector('.top .name'),
  intro = document.querySelector('.top .intro'),
  appversion = document.querySelector('.appversion'),
  appdate = document.querySelector('.appdate'),
  appurl = document.querySelector('.appurl'),
  gotoBtn = document.querySelector('.gotoBtn'),
  backBtn = document.querySelector('.backBtn');

function toPush() {
  axios
    .get(`http://60.245.62.118:81/api/search/${location.href.split('?')[1]}`)
    .then(function(res) {
      if (res.status == 200) {
        console.log(res.data);
        image.style.background = `url("http://60.245.62.118:81/storage/${res.data.image}")`;
        name.innerText = res.data.name;
        intro.innerText = res.data.description;
        appversion.innerText = res.data.version;
        appdate.innerText = res.data.lastupdate;
        appurl.innerText = res.data.url;
        gotoBtn.href = res.data.url;
        backBtn.addEventListener('click', function() {
          location.href = '../index.html';
        });
      }
    })
    .catch(function(error) {
      console.log(error);
    });
}
