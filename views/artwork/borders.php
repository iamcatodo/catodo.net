<?php $this->layout('template') ?>

<div class="row">
  <div class="small-12 medium-12 large-12 columns">
    <h2>Borders</h2>
    <p style="margin-top:50px">
      <strong>Borders</strong> is a generative installation that produces an infinite number of "digital boundaries". The algorithm is based on the idea of a set of simple constrains, using random triangles and alpha colors.
    </p>
    <blockquote>
      Borders are geographic boundaries of political entities or legal jurisdictions, such as governments, sovereign states, federated states, and other subnational entities.
      Some borders—such as a state's internal administrative border, or inter-state borders within the Schengen Area—are open and completely unguarded.
      Other borders are partially or fully controlled, and may be crossed legally only at designated border checkpoints and border zones may be controlled.
    </blockquote>
    <p>
      <i>Materials:</i> Projector Full HD (ceiling mount), white canvas, Rasperry Pi, custom software
    </p>
    <p>
       <div id="borders" width="100%" height="40%"></div>
    </p>
    <p>
       <img src="/img/projects/borders.jpg" width="100%">
    </p>
  </div>
</div>
<script type="text/javascript">
var red, green, blue = 0;
var myCanvas, canvasDiv, sketchCanvas;
function setup() {
  canvasDiv = document.getElementById('borders');
  sketchCanvas = createCanvas(canvasDiv.offsetWidth, canvasDiv.offsetWidth/2);
  myCanvas = createCanvas(width, height);
  myCanvas.parent('borders');
  background(255);
  stroke(random(50, 255), random(50, 255), random(50, 255), random(10,100));
  frameRate(20);
}
function draw() {
  if (frameCount % 50 == 0) {
    background(255);
    red   = random(50, 255);
    green = random(50, 255);
    blue  = random(50, 255);
  }
  stroke(red, green, blue, random(10,100));
  strokeWeight(random(1,50));
  line(0,random(height), width, random(height));
  fill(255);
  triangle(0, random(height), 0, height, random(width), height);
  triangle(random(width), 0, width, 0, width, random(height));
}
function windowResized() {
  resizeCanvas(canvasDiv.offsetWidth, canvasDiv.offsetWidth/2);
}
</script>
<script type="text/javascript" src="/js/p5.min.js"></script>
