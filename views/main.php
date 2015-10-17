<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Search</div>
  <div class="panel-body">
    <br/>
    <form class="form-horizontal">
        <div class="form-group">
            <div class="col-xs-offset-1 col-xs-10">
                <input type="text" class="form-control" id="playerName" placeholder="Your in-game nick"></input>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-1 col-xs-10">
                <select id="gameTypes" class="form-control" multiple="multiple">
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-4 col-xs-4">
                <button type="button" id="btnSearch" class="btn btn-block btn-lg btn-default" disabled="disabled">Go!</button>
            </div>
        </div>
    </form>
  </div>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Acceptable server distance</div>
  <div class="panel-body">
    <br/>
    <form class="form-horizontal">
        <div class="form-group">
            <div class="form-group">
                <div class="col-xs-offset-1 col-lg-10">
                    <input style="width: 100%" id="acceptable" type="text" class="span2" value="" data-slider-scale="logarithmic" data-slider-min="10" data-slider-max="40000" data-slider-step="5" data-slider-value="[500,10000]"/>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Match found!</div>
  <div class="panel-body">
    <p>Choose server</p>
  </div>

  <!-- List group -->
  <div class="list-group" id="servers">
  </div>
</div>

<!--
<div id="searches"></div>
-->
<!--
nyc - 199.202.216.51<br>
ru - 93.81.254.63<br>
br - 177.184.139.5<br>
-->

<script type="text/javascript">
    var myip = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
</script>