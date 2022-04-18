let userAuth = getUserId();

let rotated = 0;

let attempts;

if(userAuth === 1) {
    attempts = getAttempts();

}

const sectors = [
    {color:"#f82", label:"دبلوم مجاني", id: 1},
    {color:"#0bf", label:"15% خصم", id: 2},
    {color:"#fb0", label:"كورس 3 ايام مجاناً", id: 3},
    {color:"#244092", label:"50 دولار كاش باك", id: 4},
    {color:"#b0f", label:"دورة مجانية", id: 5},
    {color:"#f0b", label:"حاول مره اخرى", id: 6},
  ];
  
  const rand = (m, M) => Math.random() * (M - m) + m;
  const tot = sectors.length;
  const EL_spin = document.querySelector("#spin");
  const ctx = document.querySelector("#wheel").getContext('2d');
  const dia = ctx.canvas.width;
  const rad = dia / 2;
  const PI = Math.PI;
  const TAU = 2 * PI;
  const arc = TAU / sectors.length;
  
  let selectedSector;
  let offerDesc = document.querySelector("#offer_desc");
  let confirmSelectionBtn = document.querySelector('#confirm_selection');
  let attemptsCounter = document.querySelector("#attempts_counter");
  let remainingAttempts = document.querySelector('#remaining_attempts');

  const ctaBtns = document.querySelector('#cta_btns');

  const friction = 0.991; // 0.995=soft, 0.99=mid, 0.98=hard
  let angVel = 0; // Angular velocity
  let ang = 0; // Angle in radians


  let win;
  
  const getIndex = () => Math.floor(tot - ang / TAU * tot) % tot;


  
  function drawSector(sector, i) {
    const ang = arc * i;
    ctx.save();
    // COLOR
    ctx.beginPath();
    ctx.fillStyle = sector.color;
    ctx.moveTo(rad, rad);
    ctx.arc(rad, rad, rad, ang, ang + arc);
    ctx.lineTo(rad, rad);
    ctx.fill();
    // TEXT
    ctx.translate(rad, rad);
    ctx.rotate(ang + arc / 2);
    ctx.textAlign = "right";
    ctx.fillStyle = "#fff";
    ctx.font = "bold 15px sans-serif";
    ctx.fillText(sector.label, rad - 10, 10);
    //
    ctx.restore();
  };
  
  function rotate() {

    if(angVel !== 0) {
        rotated = 1;
    }
    const sector = sectors[getIndex()];
    ctx.canvas.style.transform = `rotate(${ang - PI / 2}rad)`;
    EL_spin.textContent = !angVel ? "ابدأ اللعب" : sector.label;
    EL_spin.style.background = sector.color;
    EL_spin.style.textAlign = "center";
    EL_spin.style.color = "white";

    if(angVel === 0 && rotated) {
        showValueDetails(sector.id);
        selectedSector = sector;
        pushAttempts();
        attempts = getAttempts();
        remainingAttempts.style.display = "block";
    }

  }
  
  function showValueDetails(id, flag = 0) {

    id = parseInt(id);

    switch (id) {
        case 1:
            offerDesc.innerHTML = 'شارك 3 من اصدقائك واحصل علي دبلوم مجاني';
            if(flag === 1){
                confirmSelectionBtn.style.display = "none";
            }else{
                confirmSelectionBtn.style.display = "block";
            }
            break;
            
        case 2:
            offerDesc.innerHTML = 'شارك صديق لك واحصل علي دبلوم مجاني';
            if(flag === 1){
                confirmSelectionBtn.style.display = "none";
            }else{
                confirmSelectionBtn.style.display = "block";
            }
            break;

        case 3:
            offerDesc.innerHTML = 'جرب كورس لمدة 3 أيام مجاناً';
            if(flag === 1){
                confirmSelectionBtn.style.display = "none";
            }else{
                confirmSelectionBtn.style.display = "block";
            }
            break;

        case 4:
            offerDesc.innerHTML = 'اشتري ماجستير مهني واحصل علي 50 دولار كاش باك';
            if(flag === 1){
                confirmSelectionBtn.style.display = "none";
            }else{
                confirmSelectionBtn.style.display = "block";
            }
            break;

        case 5:
            offerDesc.innerHTML = 'اشترك الآن واحصل على دورة مجانية';
            if(flag === 1){
                confirmSelectionBtn.style.display = "none";
            }else{
                confirmSelectionBtn.style.display = "block";
            }
            break;

        case 6:
            offerDesc.innerHTML = 'حظ سعيد المره القادمة';
            if(flag === 1){
                confirmSelectionBtn.style.display = "none";
            }else{
                confirmSelectionBtn.style.display = "block";
            }
            break;

        default:
            if(flag === 1){
                confirmSelectionBtn.style.display = "none";
            }else{
                confirmSelectionBtn.style.display = "block";
            }
            break;
    }

    


  }



  function initalizeAttemptsCounter() {

    $.ajax({
        url: "/site/getAttempts",
        type: "GET",

        success: function (data) {

        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
  }

  function pushAttempts() {

    $.ajax({
        url: "/site/setAttempts",
        type: "GET",

        success: function (data) {

        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
  }

  function frame() {
    if (!angVel) return;
    angVel *= friction; // Decrement velocity by friction
    if (angVel < 0.002) angVel = 0; // Bring to stop
    ang += angVel; // Update angle
    ang %= TAU; // Normalize angle
    rotate();

  }
  
  function engine() {
    frame();
    requestAnimationFrame(engine)
  }

  function getAttempts(){
    getWin();

    $.ajax({
        url: "/site/getAttempts",
        type: "GET",

        success: function (data) {


            if(win == 0) {

                attemptsCounter.innerHTML = 3 - data;
                remainingAttempts.style.display = "block";

                if(data >= 3) {
                    EL_spin.style.display = "none";
                    attemptsCounter.innerHTML = "تم استنزاف جميع المحاولات";
                }

            }else {

                EL_spin.style.display = "none";
                remainingAttempts.style.display = "none";
                attemptsCounter.innerHTML = "مبروك, لقد فزت, تواصل معنا عبر الواتساب لمعرفة تفاصيل اكثر عن جائزتك";
                showValueDetails(win, 1);
                ctaBtns.style.display = "block";

               // pushValueDetails(win);
            }
            //attempts = data;
            //console.log(data);

        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });


  }

  function getWin(){


    $.ajax({
        url: "/site/getWin",
        type: "GET",

        success: function (data) {
            win = data;
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });


  }

  function postPrize(sector){

    $.ajax({
        url: "/site/postPrize/" + sector.id,
        type: "GET",

        success: function (data) {
            //attempts = data;
          
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });


  }
  
  
  // INIT
  sectors.forEach(drawSector);
  rotate(); // Initial rotation
  engine(); // Start engine

  EL_spin.addEventListener("click", () => {
    if (!angVel) {
        angVel = rand(0.25, 0.35);
    } 
    
  });

  confirmSelectionBtn.addEventListener("click", () => {

    postPrize(selectedSector);
    confirmSelectionBtn.style.display = "none";
    attemptsCounter.innerHTML = "مبروك, لقد فزت, تواصل معنا عبر الواتساب لمعرفة تفاصيل اكثر عن جائزتك";
    remainingAttempts.style.display = "none";
    ctaBtns.style.display = "block";
    EL_spin.style.display = "none";

  });


  function getUserId() {

    $.ajax({
        
        url: '/site/getUserId',
        type: 'GET',

        success: function(data) {
            

            userAuth = data;
            if(userAuth == 1) {

            attempts = getAttempts();

            }
        },

        error: function(xhr, ajaxOptions, thrownError) {

            alert(xhr.status);
            alert(thrownError);
        }

    });
  }