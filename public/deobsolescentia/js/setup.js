var photo, height, width;
var cslider, hslider, vslider, volumeslider, randslider;
var button;
var osc, delay;

function preload() {
  photo = loadImage("img/1.png");
}

function setup() {
    height = 700;
    width = 484;
    var myCanvas = createCanvas(width, height);
    myCanvas.parent('obsolescentia');

    cslider = createSlider(0, 35, 0);
    cslider.parent("cslider");
    cslider.style('width', '130px');

    hslider = createSlider(30, 150, 30);
    hslider.parent("hslider");
    hslider.style('width', '130px');

    vslider = createSlider(10, 100, 10);
    vslider.parent("vslider");
    vslider.style('width', '130px');

    randslider = createSlider(1, 100, 50);
    randslider.parent("randslider");
    randslider.style('width', '130px');

    volumeslider = createSlider(0, 100, 30);
    volumeslider.parent("volumeslider");
    volumeslider.style('width', '130px');

    button = createButton('save image');
    button.parent("save");
    button.mousePressed(saveImg);

    osc = new p5.Oscillator();
    osc.setType('sine');
    osc.amp(0.2);
    osc.freq(20);
    osc.start();
    delay = new p5.Delay();

    image(photo, 0, 0);
}

function saveImg() {
  textSize(12);
  textAlign(RIGHT);
  fill(255);
  text("#sublimis", 470, 23);
  save("deobsolescentia.jpg");
}

function draw() {
  if (mouseX > 0 && mouseX < width && mouseY > 0 && mouseY < height) {
    photo.loadPixels();
    glitchSort(photo.pixels, mouseX, mouseY, round(randomGaussian(hslider.value())), round(randomGaussian(vslider.value())));
    photo.updatePixels();
    image(photo,0,0);
    // sound
    osc.freq(map(mouseX, 0, width, 50, 500));
    osc.amp(map(mouseY, 0, height, 0, 0.2));
    delay.process(osc, .8, .7, random(100,1300));
  }
  masterVolume(volumeslider.value()/100);
}

function loadBigImage(num) {
  loadImage('img/' + num + '.png', function(img) {
    photo = img;
    image(photo, 0, 0);
  });
}

function glitchSort(pix, xs, ys, xsize, ysize) {
  for (var y = ys - ysize/2; y < ys + ysize/2; y++) {
    for (var x = xs - xsize/2; x < xs + xsize/2; x++) {
      var i = 4 * ( x + y * width);
      if (i > 0 && i < pix.length-1 && random(100) < randslider.value() && pix[i+1] > pix[i]) {
        var r    = pix[i];
        var g    = pix[i+1];
        var b    = pix[i+2];
        var a    = pix[i+3];
        pix[i]   = pix[i+4];
        pix[i+1] = pix[i+5];
        pix[i+2] = pix[i+6];
        pix[i+3] = pix[i+7];
        pix[i+4] = r + random(-cslider.value(), cslider.value());
        pix[i+5] = g + random(-cslider.value(), cslider.value());
        pix[i+6] = b + random(-cslider.value(), cslider.value());
        pix[i+7] = a;
      }
    }
  }
}
