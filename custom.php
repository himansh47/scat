<?
require 'scat.php';
require 'lib/item.php';

ob_start();

head("Custom @ Scat", true);
?>
<form id="dims" class="form-horizontal" role="form">
  <div class="form-group">
    <label for="w" class="col-sm-2 control-label">Width</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="w" data-bind="value: w">
    </div>
  </div>
  <div class="form-group">
    <label for="h" class="col-sm-2 control-label">Height</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="h" data-bind="value: h">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Canvas</h3></div>
        <div class="panel-body">
          <div class="form-group">
            <label for="slim" class="col-sm-6 control-label">
              Slim (&frac34;")
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 0.49)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="thick" class="col-sm-6 control-label">
              Thick (1&frac12;")
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: (Math.max(w(), h()) > 40)
                                   ? 'Too big!'
                                   : amount(ui() * 0.75)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="chunky" class="col-sm-6 control-label">
              Chunky (1&frac12;")
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 1.49)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="epic" class="col-sm-6 control-label">
              Epic (2&frac12;")
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 1.99)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="epic" class="col-sm-6 control-label">
              Epic (2&frac12;", 10oz)
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 2.20)"></p>
            </div>
          </div>
        </div>
      </div><!-- /.panel -->
    </div><!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Floater Frame</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label for="slim" class="col-sm-7 control-label">
              Natural Slim (&frac34;")
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 0.69)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="slim-finished" class="col-sm-7 control-label">
              Finished Slim (&frac34;")
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 0.89)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="thick" class="col-sm-7 control-label">
              Natural Thick (1&frac12;")
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 1.19)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="thick-finished" class="col-sm-7 control-label">
              Finished Thick (1&frac12;")
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 1.49)"></p>
            </div>
          </div>
        </div>
      </div><!-- /.panel -->
    </div><!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Birch Panel</h3></div>
        <div class="panel-body">
          <div class="form-group">
            <label for="uncradled" class="col-sm-6 control-label">
              Uncradled (&frac14;")
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 0.49)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="thick" class="col-sm-6 control-label">
              Thick (1&frac12;")
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 0.79)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="epic" class="col-sm-6 control-label">
              Epic (2&frac12;")
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 0.99)"></p>
            </div>
          </div>
        </div>
      </div><!-- /.panel -->
    </div><!-- /.col-sm-4 -->
  </div><!-- /.row -->
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Stretch Canvas</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label for="slim" class="col-sm-6 control-label">
              &frac34;&quot; Stretch
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 1.5)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="thick" class="col-sm-6 control-label">
              &frac34;&quot; Flip Stretch
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: (Math.max(w(), h()) > 40)
                                   ? 'Too big!'
                                   : amount(ui() * 1.7)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="chunky" class="col-sm-6 control-label">
              1&frac12;&quot; Stretch
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"
                 data-bind="text: amount(ui() * 2)"></p>
            </div>
          </div>
        </div>
      </div><!-- /.panel -->
    </div><!-- /.col-sm-4 -->
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Printing</h3></div>
        <div class="panel-body">
          <div class="form-group">
            <label for="photo" class="col-sm-7 control-label">
              Photo
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(Math.max(262, area())/144 * 9.95)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="metallic" class="col-sm-7 control-label">
              Metallic
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(Math.max(80, area())/144 * 13.95)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="fine" class="col-sm-7 control-label">
              Fine Art (WC, Smooth)
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(Math.max(80, area())/144 * 19.95)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="canvas-decor" class="col-sm-7 control-label">
              Canvas (Decorative)
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(Math.max(80, area())/144 * 19.95)"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="canvas-archival" class="col-sm-7 control-label">
              Canvas (Archival)
            </label>
            <div class="col-sm-5">
              <p class="form-control-static"
                 data-bind="text: amount(Math.max(80, area())/144 * 24.95)"></p>
            </div>
          </div>
        </div>
      </div><!-- /.panel -->
    </div><!-- /.col-sm-4 -->
  </div><!-- /.row -->
</form>
<script>
function CalcModel() {
  var self= this;

  self.w= ko.observable(8);
  self.h= ko.observable(10);

  self.ui= ko.computed(function() {
    return parseFloat(self.w()) + parseFloat(self.h());
  });

  self.area= ko.computed(function() {
    return parseFloat(self.w()) * parseFloat(self.h());
  });
};

ko.applyBindings(new CalcModel());
</script>
<?
foot();
