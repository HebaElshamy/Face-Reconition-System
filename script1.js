const video = document.getElementById("video");

Promise.all([
  faceapi.nets.ssdMobilenetv1.loadFromUri("/models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("/models"),
  faceapi.nets.faceLandmark68Net.loadFromUri("/models"),
]).then(startWebcam);

function startWebcam() {
  navigator.mediaDevices
    .getUserMedia({
      video: true,
      audio: false,
    })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((error) => {
      console.error(error);
    });
}
var students = [];
fetch('http://localhost/final_face_reconition_system/get_labels.php') 
  .then(response => response.json())
  .then(data => {
    students = data;
    console.log(students); 
  })
  .catch(error => console.error('حدث خطأ في جلب البيانات:', error));


  document.getElementById("printButton").addEventListener("click", function () {
    
    // console.log("المصفوفة:", labelsArray);
    const myArray = labelsArray;


    const url = 'http://localhost/final_face_reconition_system/set_labels.php';
    const options = {
      method: 'POST', 
      headers: {
        'Content-Type': 'application/json', 
      },
      body: JSON.stringify(myArray), // تحويل المصفوفة إلى نص JSON وإرسالها كجسم
    };
    fetch(url, options)
      .then(response => response.text()) 
      .then(data => {
        console.log(data);
      })
      .catch(error => {
        console.error('حدث خطأ أثناء إرسال الطلب:', error);
      });
});
  
  

function getLabeledFaceDescriptions() {
  const labels = students;
  
  return Promise.all(
    labels.map(async (label) => {
      const descriptions = [];
      for (let i = 1; i < 2; i++) {
        const img = await faceapi.fetchImage(`./labels/${label}/${i}.png`);
        const detections = await faceapi
          .detectSingleFace(img)
          .withFaceLandmarks()
          .withFaceDescriptor();
        if (detections && detections.descriptor) {
          descriptions.push(detections.descriptor);
        }
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  );
}
var labelsArray = [];
video.addEventListener("play", async () => {
  const labeledFaceDescriptors = await getLabeledFaceDescriptions();
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
  const canvas = faceapi.createCanvasFromMedia(video);
  document.body.append(canvas);
  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);
  setInterval(async () => {
    const detections = await faceapi
      .detectAllFaces(video)
      .withFaceLandmarks()
      .withFaceDescriptors();

    const resizedDetections = faceapi.resizeResults(detections, displaySize);

    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

    const results = resizedDetections.map((d) => {
      return faceMatcher.findBestMatch(d.descriptor);
    });
    results.forEach((result, i) => {
      const box = resizedDetections[i].detection.box;
      const label = result.toString();
      if (label.toLowerCase() !== "unknown") {
        const drawBox = new faceapi.draw.DrawBox(box, {
          label: label, // استخدام الـ label نفسه كما هو
        });
        drawBox.draw(canvas);
        if(label.split(" ")[0] !=="unknown"){
          console.log("Label:", label.split(" ")[0]);
          // labelsArray.push(label.split(" ")[0]);
          if (!labelsArray.includes(label.split(" ")[0])) {
            labelsArray.push(label.split(" ")[0]);
          }
          const audio = document.getElementById("audio");
          audio.play(); 
        }
        
      }
    });
  }, 100);
});
