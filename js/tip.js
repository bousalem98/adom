var appname = 'layoutjs';
    
var app = angular.module(appname, ['ngMessages', 'ngAnimate']);

// Bootstrap angularjs app
angular.element(document).ready(function () {
    console.log("App: bootstraping.");
    angular.bootstrap(document, [appname]);
});

/*textInputLayout*/

app.directive('textInputLayout', function(){
  const ATTR_FOCUS = 'focused';
  const ATTR_FLOATING = 'floated';
  const ATTR_AREA_DISABLED = 'aria-disabled';
  
  return {
    restrict: 'E',
    transclude: true,
    scope: true,
    template: '\
      <div class="floated-label-placeholder">&nbsp;</div>\
      <div class="lable-and-input-container layout-row">\
        <span class="prefix">{{prefix}}</span>\
        <label>{{label}}</label>\
        <div class="input-container flex" ng-transclude></div>\
        <span class="suffix">{{suffix}}</span>\
        <div class="input-counter" ng-if="cMax !== undefined">{{cMin}} / {{cMax}}</div>\
      </div>',
    controller: function($scope, $element){
      this.setPlaceHolder = function(placeholder){
         $scope.label = placeholder;
      }
      
      this.focus = function(){
        if($element.attr(ATTR_FOCUS) === undefined)
          $element.attr(ATTR_FOCUS, '');
      }
      
      this.blur = function(){
        if($element.attr(ATTR_FOCUS) !== undefined)
          $element.removeAttr(ATTR_FOCUS);
      }
      
      this.labelIsFloating = function(v){
        if(!v && $element.attr(ATTR_FLOATING) !== undefined)
          $element.removeAttr(ATTR_FLOATING);
        else if(v && $element.attr(ATTR_FLOATING) === undefined)
          $element.attr(ATTR_FLOATING, '');
      }
      
      this.addClass = function(v){
        if(!$element.hasClass(v)) $element.addClass(v);
      }
      
      this.removeClass = function(v){
        if($element.hasClass(v)) $element.removeClass(v);
      }
      
      this.autogrow = false;
      this.autogrowText = null;
      
      this.updateMirror = function(text){
        if(this.autogrowText){
          this.autogrowText.html(text);
        }
      }
      
      this.setCounter = function(min, max){
        if(max === undefined) return;
        
        $scope.$apply(function(){
          $scope.cMin = min;
          $scope.cMax = max;
        });
      }
      
      this.setSuffix = function(suffix){
        $scope.$apply(function(){
          $scope.suffix = suffix;
        });
      }
      
      this.setPrefix = function(prefix){
        $scope.$apply(function(){
          $scope.prefix = prefix;
        });
      }
      
      this.disabled = $element.attr('disabled') !== undefined && $element.attr('disabled') !== false;
      if(this.disabled) $element.attr(ATTR_AREA_DISABLED, this.disabled);
      
      return this;
    },
    compile: function($element){
      return {
        pre: function(){

        },
        post: function($scope, $element, $attrs, ngCtrl){
          if(ngCtrl.autogrow){
            var root = angular.element($element[0].querySelector('.input-container'))
              .addClass('autogrow-textarea');
              
            ngCtrl.autogrowText = angular.element('<div/>')
              .addClass('mirror-text')
              .attr(ATTR_AREA_DISABLED, 'true')
              .text('&nbsp');
              
            root.prepend(ngCtrl.autogrowText);
          }
      
          var input = $element[0].querySelector('input, textarea');
            
          $element.bind('click', function(){
            if(input) input.focus();
          });
          
        }
      }
    }
  }
});

var input = ['$timeout', function($timeout){
  const ATTR_AREA_DISABLED = 'aria-disabled';
  const ATTR_DISABLED = 'disabled';
  const CLASS_NGVALID = 'ng-valid';
  const CLASS_NGINVALID = 'ng-invalid';
  const CLASS_INVALID_MAXLENGTH = 'ng-invalid-maxlength';
  
  return {
    restrict: 'E',
    require: ['?ngModel', '?^textInputLayout'],
    scope:{
      placeholder: '@',
      label: '@',
      value: '@',
      rows: '@',
      maxRows: '@',
      ngMaxlength: '@',
      prefix: "@",
      suffix: "@"
    },
    link: function($scope, $element, $attrs, controllers){
      if(!controllers) return;
      var xg = controllers[0];
      var ngCtrl = controllers[1];
      
      if(ngCtrl === null) return;
      
      if($scope.rows === undefined) $scope.rows = 1;
      if($scope.maxRows === undefined) $scope.maxRows = 1;
      
      if(ngCtrl.disabled){
        $element.attr(ATTR_AREA_DISABLED, 'true');
        $element.attr(ATTR_DISABLED, '');
      }
      
      var noLabelFloat = $attrs.noLabelFloat !== undefined,
        alwaysFloatLabel = $attrs.alwaysFloatLabel !== undefined;
      
      $element.bind('focus', function(){
        ngCtrl.focus();
      })
      
      $element.bind('blur', function(){
        ngCtrl.blur();
      })
      
      ngCtrl.labelIsFloating(alwaysFloatLabel);
      
      if(noLabelFloat) return;

      if($scope.placeholder){
        if($scope.label && $scope.label.length>0)
          ngCtrl.setPlaceHolder($scope.label);
        else
        {
          ngCtrl.setPlaceHolder($scope.placeholder);
          $element.removeAttr('placeholder');
        }
      }
      
      if(alwaysFloatLabel) return;
      
      function setChanges(){
        // check valid and apply to root
        if(xg){
          
          if(xg.$error['maxlength'])
            ngCtrl.addClass(CLASS_INVALID_MAXLENGTH);
          else
            ngCtrl.removeClass(CLASS_INVALID_MAXLENGTH);
            
          if(xg.$invalid){
            ngCtrl.addClass(CLASS_NGINVALID);
            ngCtrl.removeClass(CLASS_NGVALID);
          } else if(xg.$valid){
            ngCtrl.addClass(CLASS_NGVALID);
            ngCtrl.removeClass(CLASS_NGINVALID);
          }
        }
        
        ngCtrl.labelIsFloating($element.val().length > 0);
        
        if(ngCtrl.autogrow) {
          var token = $element.val() ? $element.val().replace(/&/gm, '&amp;').replace(/"/gm, '&quot;').replace(/'/gm, '&#39;').replace(/</gm, '&lt;').replace(/>/gm, '&gt;').split('\n') : [''];
          
          ngCtrl.updateMirror(constrain(token));
        }
      }
      
      $timeout(function(){ 
        // if input has value
        if($element.val().length > 0) setChanges();
        
        // autofocus
        if($attrs.autofocus !== undefined) $element.focus();
        
        // init counter
        ngCtrl.setCounter($element.val().length, $scope.ngMaxlength);
        
        ngCtrl.setPrefix($scope.prefix);
        ngCtrl.setSuffix($scope.suffix);
      }, 100)
      
      
      $scope.$watch('value', function(){ setChanges();});
      
      $element.bind('input', function(){
        setChanges();
        
        ngCtrl.setCounter($element.val().length, $scope.ngMaxlength);
      });
      
      // auto resizing
      if($element[0].tagName === 'TEXTAREA' && $attrs.autogrow !== undefined){
        ngCtrl.autogrow = true;
      }
      
      function constrain(tokens){
        var _tokens;
        tokens = tokens || [''];
        // Enforce the min and max heights for a multiline input to avoid measurement
        if ($scope.maxRows > 0 && tokens.length > $scope.maxRows) {
        	_tokens = tokens.slice(0, $scope.maxRows);
        } else {
        	_tokens = tokens.slice(0);
        }
        while ($scope.rows > 0 && _tokens.length < $scope.rows) {
        	_tokens.push('');
        }
        
        // Use &#160; instead &nbsp; of to allow this element to be used in XHTML.
        return _tokens.join('<br/>') + '&#160;';
      }
    }
  };
}];

app.directive('input', input)
  .directive('textarea', input);