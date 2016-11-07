<?php $this->layout('template') ?>

<div class="row">
  <div class="small-12 medium-12 large-12 columns">
    <h2>Bash art</h2>
    <p style="margin-top:50px">
      <strong>Bash art</strong> is a collection of micro-programs written in <a href="https://en.wikipedia.org/wiki/Bash_%28Unix_shell%29">Bash</a>, the shell language of UNIX-like computer operating systems. This project is part of a artist's research started in 1996 with the design of micro codes to produce interesting behaviour in the field of visual art, and sound art.
    </p>
    <p>
      The choice of Bash as language for these experiments is driven by a specific need, research in fields that are very far from the concept of art itself. The artwork produced using this computer language are based on ASCII characters, printed using infinite loops. The result is a set of digital prints.
    </p>
    <p>
      The following code produces an infinite random maze, based on the idea of <a href="http://10print.org/">10 PRINT</a> project.
      <pre>for((;;x=RANDOM%2+2571)){ printf "\e[1;$((RANDOM%7+40))m\U$x";}</pre>
    </p>
    <p>
      The following code prints random bars with random color and a size based on the percentage of the CPU usage.
      <pre>for((;;)){ x=$(printf "%.0f" $(top -bn2 -d0.01|grep '^%Cpu'|tail -n1|awk '{print $2+$4+$6}'));printf "\e[1;$((RANDOM%7+40))m%*s" $x;}</pre>
    </p>
    <p>
      <i>Materials:</i> digital prints 32x32 cm, custom software
    </p>
    <p>
      <img src="/img/projects/bashart.jpg" width="100%">
    </p>
    <p>
      <img src="/img/projects/bashart2.jpg" width="100%">
    </p>
  </div>
</div>
