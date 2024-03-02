const body = document.querySelector("body");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

sidebarClose.addEventListener("click", () => {
  sidebar.classList.add("close", "hoverable");
});
sidebarExpand.addEventListener("click", () => {
  sidebar.classList.remove("close", "hoverable");
});

// sidebar.addEventListener("mouseenter", () => {
//   if (sidebar.classList.contains("hoverable")) {
//     sidebar.classList.remove("close");
//   }
// });
// sidebar.addEventListener("mouseleave", () => {
//   if (sidebar.classList.contains("hoverable")) {
//     sidebar.classList.add("close");
//   }
// });





submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});

if (window.innerWidth < 768) {
  sidebar.classList.add("close");
} else {
  sidebar.classList.remove("close");
}





/*********************file */

const divfile = document.querySelector(".file-group");
const fileInput = document.querySelector(".file-input");
const previewImageElement = document.querySelector(".preview-image");
const fileNameElement = document.querySelector(".file-name");
const previewImagesDiv = document.querySelector(".preview-image-div");
divfile.addEventListener("click", () => {
    fileInput.click();
});

document.addEventListener("DOMContentLoaded", function () {
  // Get the file input element
 

  // Set the 'accept' attribute to allow only image files
  fileInput.accept = "image/*";
});
fileInput.addEventListener("change", ({ target }) => {
  const files = target.files;

  if (files.length > 1) {
    divfile.style.height= "100%";
    divfile.style.gap = "1.1rem"; 
    previewImagesDiv.style.flexDirection = "column";
  
  }
  if (files.length > 0) {
      // Clear previous previews
      previewImagesDiv.innerHTML = "";

      for (let i = 0; i < files.length; i++) {
          const file = files[i];
          const fileName = file.name;

          // Create a preview element for each file
          const previewElement = document.createElement("div");
          previewElement.classList.add("preview-image-div");
         

          // Preview the image (if it's an image)
          if (file.type.startsWith("image/")) {
              const reader = new FileReader();
              reader.onload = function (e) {
                  const imageElement = document.createElement("img");
                  imageElement.classList.add("preview-image");
                  imageElement.src = e.target.result;
                  previewElement.appendChild(imageElement);

                      // Display the file name
          const fileNameElement = document.createElement("p");
           fileNameElement.classList.add("file-name");
          fileNameElement.textContent = fileName;
          previewElement.appendChild(fileNameElement);
              };
              reader.readAsDataURL(file);
          }

          previewImagesDiv.appendChild(previewElement);
      }
  } else {
      // Clear previews if no files selected
      previewImagesDiv.innerHTML = "";
  }
});





function uploadFile(name){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/upload.php");
  xhr.upload.addEventListener("progress", ({loaded, total}) =>{
    let fileLoaded = Math.floor((loaded / total) * 100);
    let fileTotal = Math.floor(total / 1000);
    let fileSize;
    (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024*1024)).toFixed(2) + " MB";
    let progressHTML = `<li class="row">
                          <i class="fas fa-file-alt"></i>
                          <div class="content">
                            <div class="details">
                              <span class="name">${name} • Uploading</span>
                              <span class="percent">${fileLoaded}%</span>
                            </div>
                            <div class="progress-bar">
                              <div class="progress" style="width: ${fileLoaded}%"></div>
                            </div>
                          </div>
                        </li>`;
    uploadedArea.classList.add("onprogress");
    progressArea.innerHTML = progressHTML;
    if(loaded == total){
      progressArea.innerHTML = "";
      let uploadedHTML = `<li class="row">
                            <div class="content upload">
                              <i class="fas fa-file-alt"></i>
                              <div class="details">
                                <span class="name">${name} • Uploaded</span>
                                <span class="size">${fileSize}</span>
                              </div>
                            </div>
                            <i class="fas fa-check"></i>
                          </li>`;
      uploadedArea.classList.remove("onprogress");
      uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
    }
  });
  let data = new FormData(divfile);
  xhr.send(data);
}
