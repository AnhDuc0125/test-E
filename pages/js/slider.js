//fake data
images = [
  "photos/img1.png",
  "photos/img2.jpg",
  "photos/img3.png",
  "photos/img4.png",
  "photos/img5.png",
];

btn = document.querySelectorAll(".icon");
img = document.querySelector("img");

counter = 0;
let time = 4000;

btn.forEach(function (item) {
  item.onclick = function () {
    if (item.classList.contains("next")) {
      counter++;
    } else {
      counter--;
    }

    if (counter < 0) {
      counter = images.length - 1;
    } else if (counter > images.length - 1) {
      counter = 0;
    }

    //smooth transition
    img.style.opacity = 0;
    setTimeout(() => {
      img.src = images[counter];
      img.style.opacity = 1;
    }, 250);

    clearInterval(timer);
    timer = setInterval(() => {
      counter++;
      if (counter > images.length - 1) {
        counter = 0;
      }
      img.style.opacity = 0;
      setTimeout(() => {
        img.src = images[counter];
        img.style.opacity = 1;
      }, 250);
    }, time);
  };
});

//automatic
let timer = setInterval(() => {
  counter++;
  if (counter > images.length - 1) {
    counter = 0;
  }
  img.style.opacity = 0;
  setTimeout(() => {
    img.src = images[counter];
    img.style.opacity = 1;
  }, 250);
}, time);
