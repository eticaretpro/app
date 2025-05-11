<?php defined('ALTUMCODE') || die() ?>



<?php
/* Custom close button */
$notification->settings->html = str_replace('{CLOSE_BUTTON}', '<button class="altumcode-close" style="color:' . $notification->settings->close_button_color . ';">×</button>', $notification->settings->html);

?>

<?php ob_start() ?>
<div role="dialog" style='font-family: <?= $notification->settings->font ?? 'inherit' ?>!important;'>
    
<style>



.greet_wrapper {
  transition: all 0.3s;
  width: 170px !important;
  height: 170px !important;
  cursor: pointer !important;
  z-index: 9999;
}
.greet_wrapper video {
  border-radius: 10px !important;
  border: <?= $notification->settings->border_width ?>px solid <?= $notification->settings->border_color ?> !important;
  object-fit: cover;
  width: 100% !important;
  height: 100% !important;
-webkit-mask-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYGBgAAgwAAAEAAGbA+oJAAAAAElFTkSuQmCC);
}
.greet_wrapper .greet_text {
  color: <?= $notification->settings->title_color ?>;
  position: absolute !important;
  top: 50% !important;
  z-index: 99 !important;
  left: 50% !important;
  transform: translate(-20%, -50%) !important;
  width: 100% !important;
  font-size: 25px !important;
  margin: 0 !important;
}
.greet_wrapper .greet_close {
  position: absolute !important;
  top: 5px;
  right: 10px;
  opacity: 0;
  transition: 0.3s;
}
.greet_wrapper:hover .greet_close {
  opacity: 1;
}
.greet_wrapper .greet_close i {
  font-size: 25px;
}
.greet_wrapper-resize {
  transform: scale(0.67);
}
.greet_wrapper [class*="greet_full-"] {
  display: none;
}
.greet_wrapper [class*="greet_full-"] .greet_media-action {
  display: none;
}
.greet_wrapper .greet_full-close {
  display: none;
}
.greet_wrapper-full {
  width: 300px !important;
  height: 500px !important;
}
.greet_wrapper-full video {
  border-radius: 10px !important;
  border: none !important;
  object-fit: cover !important;
  width: 100% !important;
  height: 100% !important;
}
.greet_wrapper-full .greet_text {
  display: none;
}
.greet_wrapper-full .greet_close {
  display: none !important;
}
.greet_wrapper-full.greet_wrapper-resize {
  transform: inherit !important;
}
.greet_wrapper-full [class*="greet_full-"] {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  position: absolute !important;
  width: 40px !important;
  height: 40px !important;
  border-radius: 50% !important;
  background-color: #161e2e78 !important;
  color: #fff !important;
  transition: all 0.5s !important;
}
.greet_wrapper-full [class*="greet_full-"] i {
  font-size: 25px !important;
}
.greet_wrapper-full [class*="greet_full-"]:hover {
  background-color: #161e2e9a !important;
}
.greet_wrapper-full .greet_full-close {
  top: 5px !important;
  right: 5px !important;
}
.greet_wrapper-full .greet_full-play {
  display: none !important;
}
.greet_wrapper-full .greet_media-action {
  display: flex !important;
  flex-direction: column !important;
  top: 5px !important;
  left: 5px !important;
  position: absolute !important;
}
.greet_wrapper-full .greet_media-action [class*="greet_full-"] {
  position: unset;
  margin-bottom: 5px;
}
.greet_wrapper .greet-btn {
  display: none;
}
.greet_wrapper.greet_wrapper-full .greet-btn {
  display: block;
  position: absolute;
  bottom: 20px !important;
  left: 50% !important;
  transform: translate(-50%);
  text-align: center;
  width: 100% !important;
  transition: all 0.5s;
}
.greet_wrapper.greet_wrapper-full .greet-btn a {
  text-decoration: none;
  text-decoration: none;
  padding: 10px 15px !important;

  width: 75% !important;
  color: #fff;
  display: block !important;
  border-radius: 5px !important;
  background-color: #7432ff !important;
  margin: 0 auto !important;
  transition: 0.3s !important;
}
.greet_wrapper.greet_wrapper-full .greet-btn a:hover {
  background-color: #161e2e !important;
}

/* change button start */
.greet_change-video {
  display: none;
}

.greet_wrapper-full .greet_change-video {
  display: flex !important;
  gap: 6px !important;
  justify-content: center !important;
  flex-wrap: wrap;
  position: absolute !important;
  width: 100% !important;
  bottom: 20px !important;
  transition: 0.3s !important;
}

.greet_wrapper-full .greet_change-video [class*="video"] a {
  transition: 0.3s;
  background-color: <?= $notification->settings->button_background_color ?> !important;
  color: <?= $notification->settings->button_color ?> !important;
  display: block;
  padding: 10px 15px !important;
  border-radius: 8px !important;
  text-align: center !important;
  font-size: 14px !important;
  text-decoration: none !important;
}
.greet_wrapper-full .greet_change-video [class*="video"] a:hover {
  background-color: #161e2e !important;
}
/* change button end */

.greet-left {
  left: 30px;
  right: auto;
}

.greet-left.greet_wrapper {
  transform-origin: bottom left;
}


@media only screen and (max-width: 575px) {
  .greet_wrapper {
    width: 150px !important;
    height: 150px !important;
  }
  .greet_wrapper-full {
    width: 250px !important;
    height: 400px !important;
  }
  /* change button start */
  .greet_wrapper-full .greet_change-video {
    padding: 0 !important;
    flex-direction: column !important;
    bottom: 10px !important;
  }
  .greet_change-video > div {
    margin-left: 15px !important;
    margin-right: 15px !important;
  }
  .greet_wrapper-full [class*="greet_full-"] {
    width: 30px !important;
    height: 30px !important;
  }
  .greet_wrapper-full [class*="greet_full-"] i {
    font-size: 16px !important;
  }
  .greet_wrapper-full .greet_full-play {
    width: 40px !important;
    height: 40px !important;
  }
  /* change button end */
}

@media only screen and (max-width: 450px) {
  .greet_wrapper {
    width: 135px !important;
    height: 135px !important;
  }
  .greet_wrapper-full {
    width: 200px !important;
    height: 350px !important;
  }
}







</style>




    <div id="greet_wrapper" class="greet_wrapper greet_toggler">
      <!--Use (greet-left) class rtl-->
      <video id="greet_video" preload="metadata">
        <source
          id="playVideo"
          type="video/mp4"
          src="<?= (substr($notification->settings->image, 0, 4) === 'http') ? $notification->settings->image : \Altum\Uploads::get_full_url('notifications') . $notification->settings->image ?>#t=0.1"
        />
      </video>
      <div id="greet_text" class="greet_text">
       <svg width="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.6935 15.8458L15.4137 13.059C16.1954 12.5974 16.1954 11.4026 15.4137 10.941L10.6935 8.15419C9.93371 7.70561 9 8.28947 9 9.21316V14.7868C9 15.7105 9.93371 16.2944 10.6935 15.8458Z" fill="#FFFFFF80"/>
</svg>

      </div>

      <div onclick="greetClose()" class="greet_close">
        <svg width="16" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#FFFFFF" d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55  c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55  c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505  c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55  l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719  c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/></svg>
      </div>
      <div id="greet_full-btn">
        <div onclick="greetFullClose()" class="greet_full-close">
          <svg width="16" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#FFFFFF" d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55  c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55  c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505  c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55  l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719  c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/></svg>
        </div>
        <div id="greet_full-play" class="greet_full-play" style="display: none !important;">
          <i class="icofont-play"></i>
        </div>
        <div class="greet_media-action">
          <div id="greet_full-replay" class="greet_full-replay">
            <i class="icofont-refresh"></i>
          </div>
          <div id="greet_full-volume" class="greet_full-volume">
            <i class="icofont-volume-up"></i>
          </div>
          <div id="greet_full-mute" class="greet_full-mute">
            <i class="icofont-ui-mute"></i>
          </div>
          <div id="greet_full-expand" class="greet_full-expand">
            
            
       <svg fill="#FFFFFF" width="16" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> <rect x="0"  /> <g> <path d="M17 13V3H3v10h14zM5 17h10v-2H5v2z"/> </g> </svg>

          </div>
        </div>
        <div class="greet_change-video">
         
          <div class="greet_video">
            <a target="<?= $notification->settings->url_new_tab ? '_blank' : '_self' ?>" href="<?= $notification->settings->button_url ?>"><?= $notification->settings->button_text ?></a>
          </div>
        </div>
      </div>
     
    </div>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({
    content: <?= json_encode($html) ?>,
    display_mobile: <?= json_encode($notification->settings->display_mobile) ?>,
    display_desktop: <?= json_encode($notification->settings->display_desktop) ?>,
    display_trigger: <?= json_encode($notification->settings->display_trigger) ?>,
    display_trigger_value: <?= json_encode($notification->settings->display_trigger_value) ?>,
    duration: <?= $notification->settings->display_duration === -1 ? -1 : $notification->settings->display_duration * 1000 ?>,
    close: true,
    display_frequency: <?= json_encode($notification->settings->display_frequency) ?>,
    position: <?= json_encode($notification->settings->display_position) ?>,
    trigger_all_pages: <?= json_encode($notification->settings->trigger_all_pages) ?>,
    triggers: <?= json_encode($notification->settings->triggers) ?>,
    on_animation: <?= json_encode($notification->settings->on_animation) ?>,
    off_animation: <?= json_encode($notification->settings->off_animation) ?>,
    animation: <?= json_encode($notification->settings->animation) ?>,
    animation_interval: <?= (int) $notification->settings->animation_interval ?>,

    
    notification_id: <?= $notification->notification_id ?>
}).initiate({
    displayed: main_element => {

        let greetWrapper = document.getElementById("greet_wrapper");
let greetVideo = document.getElementById("greet_video");
let greetToggler = document.querySelector(".greet_toggler");
let greetFullPlay = document.getElementById("greet_full-play");
let greetFullReplay = document.getElementById("greet_full-replay");
let greetFullVolume = document.getElementById("greet_full-volume");
let greetFullMute = document.getElementById("greet_full-mute");
let greetFullExpand = document.getElementById("greet_full-expand");
let greetFullBtn = document.getElementById("greet_full-btn");
let greetText = document.getElementById("greet_text");

let greetAddFrom = document.querySelector(".greet_add-form");
let emailForm = document.querySelector(".greet_email-form");
let greetEmailSubmit = document.querySelector(".greet_email-submit");


/* change video start */
let video = document.getElementById("playVideo");
/* change video end */

greetVideo.autoplay = true;
greetVideo.muted = true;
greetVideo.loop = true;
greetFullExpand.addEventListener("click", () => {
  greetVideo.requestFullscreen();
});

// Pause video on borwser tab switch
var frontend_scripts = { pause_on_switch: "1" };
if (frontend_scripts.pause_on_switch) {
  document.addEventListener("visibilitychange", () => {
    if (document["hidden"] || (emailForm && emailForm.classList.contains("email-form-active"))) {
      greetVideo.pause();
    } else {
      greetVideo.play();
      greetFullPlay.style.display = "none";
      greetWrapper.classList.add("play-video");
    }
  });
}

// REPLAY GREET
greetFullReplay.addEventListener("click", () => {
  greetVideo.currentTime = 0;
});
// VOLUME UP
greetFullVolume.addEventListener("click", () => {
  greetFullMute.style.display = "flex";
  greetFullVolume.style.display = "none";
  greetVideo.muted = true;
});
// VOLUME MUTE
greetFullMute.addEventListener("click", () => {
  greetFullVolume.style.display = "flex";
  greetFullMute.style.display = "none";
  greetVideo.muted = false;
});
// VIDEO PLAY
greetFullPlay.addEventListener("click", () => {
  greetVideo.play();
  greetFullPlay.style.display = "none";
  greetWrapper.classList.toggle("play-video");
});
// CLOSE TOTAL GREET
greetClose = () => {
  greetWrapper.style.display = "none";
};

// CLOSE FULL GREET
greetFullClose = () => {
  greetWrapper.classList.remove("greet_wrapper-full");
  greetWrapper.classList.remove("play-video");
  greetVideo.muted = true;
  greetVideo.play();
  greetFullBtn.style.display = "none";
};
// OPEN FULL GREET
const videoModal = () => {
  if (!greetWrapper.classList.contains("greet_wrapper-full")) {
    greetVideo.currentTime = 0;
  }
  greetWrapper.classList.add("greet_wrapper-full");
  greetWrapper.classList.toggle("play-video");
  greetVideo.muted = false;

  greetFullMute.style.display = "none";
  greetFullVolume.style.display = "flex";
  if (greetWrapper.classList.contains("play-video")) {
    greetVideo.play();
    greetFullPlay.style.display = "none";
  } else {
    greetVideo.pause();
    greetFullPlay.style.display = "flex";
  }
  greetFullBtn.style.display = "block";
};

greetVideo.addEventListener("click", () => {
  videoModal();
});
greetText.addEventListener("click", () => {
  videoModal();
});
/* change video start */
function videoChange(videoUrl) {
  video.setAttribute("src", videoUrl);
  greetVideo.load();
  greetVideo.play();
  greetFullPlay.style.display = "none";
  greetWrapper.classList.toggle("play-video");
}
/* change video end */

/* Email form */
if (greetAddFrom) {
  greetAddFrom.addEventListener("click", () => {
    emailForm.classList.add("email-form-active");
    greetVideo.pause();
  });
}
greetFormClose = () => {
  emailForm.classList.remove("email-form-active");
  greetVideo.play();
  greetFullPlay.style.display = "none";
};
if (emailForm) {
  emailForm.addEventListener("submit", function (e) {
    const formData = new FormData(emailForm);
    e.preventDefault();
    let object = {};
    formData.forEach((value, key) => {
      object[key] = value;
    });
    let json = JSON.stringify(object);
    greetEmailSubmit.innerHTML = "Please wait...";

    fetch("https://api.web3forms.com/submit", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: json,
    })
      .then(async (response) => {
        let json = await response.json();
        if (response.status == 200) {
          greetEmailSubmit.innerHTML = json.message;
        } else {
          greetEmailSubmit.innerHTML = json.message;
        }
      })
      .catch((error) => {
        console.log(error);
        greetEmailSubmit.innerHTML = "Something went wrong!";
      })
      .then(function () {
        emailForm.reset();
        setTimeout(() => {
          greetEmailSubmit.innerHTML = "Send email";
        }, 5000);
      });
  });
}


        

    }
});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
