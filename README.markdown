html5ImageUploader
==========
Copper and upload an images using HTML5 Cover

About
-----
Created by [Daoliang Han](htt://www.handaoliang.com) (c) 2012

html5ImageUploader is open sourced under <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU GPL 2</a> or later and <a href="http://www.gnu.org/licenses/lgpl-2.1.html">GNU LGPL 2</a> or later.

This distribution also includes jQuery JavaScript Library
http://jquery.com/ Copyright 2010, John Resig Dual licensed under the MIT or GPL Version 2 licenses. http://jquery.org/license

If this license doesn't suit you mail me at handaoliang (at) gmail.com.

-------
### <a href="http://www.handaoliang.com/html5ImageUploader">Demo</a>

How to
------
Simplely add below code in your web page.

    <script type="text/javascript" src="js/ComnovoUtil.js"></script>
    <script type="text/javascript" src="js/ImageCropper.js"></script>
    <script type="text/javascript" src="js/UploadImages.js"></script>

and keep below code in your page

    <div id="copper_container">
        <a id="back_btn"></a>
        <a id="rotate_btn"></a>
        <div id="dragdrop_info">Drag and drop<br>your image here</div>
        <div id="drag_drop_area"></div>
        <div id="cropper_img_area_bg"></div>
        <div id="status" style=""></div>
        <a id="select_img_button" href="javascript:void(0);" onclick="document.getElementById('image_file').click();"></a>
        <input type="file" id="image_file" size="10" style="visibility:hidden;" />

        <canvas id="cropper_img_area"></canvas>
        <div id="preview_container">
            <canvas id="preview_100_px"></canvas>
            <span>Big Image<br /> 100px x 100px</span>

            <canvas id="preview_50_px"></canvas>
            <span>Small Image 50x50</span>

            <a id="save_img_button"></a>
        </div>
    </div>
    <img id="upload_success_preview_big" />
    <img id="upload_success_preview_small" />

Version
-------
#### 1.0.0
* drag-and-drop file select in FF, Chrome.
* rotate images.
* hashed file system.
