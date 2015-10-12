<!doctype html>
<html lang="en" data-ng-app="FileManagerApp">
<head>
  <!--
    * Angular FileManager v1.4.4 (https://github.com/joni2back/angular-filemanager)
    * Jonas Sciangula Street <joni2back@gmail.com>
    * Licensed under MIT (https://github.com/joni2back/angular-filemanager/blob/master/LICENSE)
  -->
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>angular-filemanager</title>

  <!-- third party -->
    <script src="/js/main_admin.min.js"></script>
    <script src="/js/angular/angular.min.js"></script>
    <script src="/js/angular-translate/angular-translate.min.js"></script>
    <script src="/js/angular-cookies/angular-cookies.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />

    <link href="/css/angular-filemanager.css" rel="stylesheet">
    <script src="/js/angular-filemanager/dist/angular-filemanager.min.js"></script>

  <script type="text/javascript">
    //example to override angular-filemanager default config
    angular.module('FileManagerApp').config(['fileManagerConfigProvider', function (config) {
      var defaults = config.$get();
      config.set({
        appName: 'github.com/joni2back/angular-filemanager',

        listUrl: "{{ route('admin.filemanager.images.list') }}",
        uploadUrl: "{{ route('admin.filemanager.images.upload') }}",
        renameUrl: "{{ route('admin.filemanager.images.rename') }}",
        copyUrl: "{{ route('admin.filemanager.images.copy') }}",
        removeUrl: "{{ route('admin.filemanager.images.remove') }}",
        editUrl: "{{ route('admin.filemanager.images.edit') }}",
        getContentUrl: "{{ route('admin.filemanager.images.content') }}",
        createFolderUrl: "{{ route('admin.filemanager.images.createFolder') }}",
        downloadFileUrl: "{{ route('admin.filemanager.images.download') }}",
        compressUrl: "{{ route('admin.filemanager.images.compress') }}",
        extractUrl: "{{ route('admin.filemanager.images.extract') }}",
        permissionsUrl: "{{ route('admin.filemanager.images.permissions') }}"
      });
    }]);
  </script>
</head>

<body class="ng-cloak">

 <angular-filemanager></angular-filemanager>

  <script type="text/javascript">
    $(document).ready(function(){
        $('angular-filemanager').on('click', '.table-files a.ng-binding', function() {
          // alert('owie');
          // $('#imagepreview .modal-footer')
          $scope = angular.element(this).scope();
          if($scope.item.isImage()){
            $selectScript = '$(\'#photo_path\', window.opener.document).val(\'/images' + $scope.item.model.fullPath() +  '\'); window.close();'; 
            if($('#imagepreview .modal-footer .select-img').length) {
              $('#imagepreview .modal-footer .select-img').attr('onclick', $selectScript);
            } else {
              $('#imagepreview .modal-footer').prepend(
                '<button class="btn btn-default select-img" type="button"onclick="' + $selectScript + '">Select</button>');
            }    
          }
        });
    });



  </script>
</body>
</html>
