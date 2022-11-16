const toDataURL = url =>
    fetch(url)
    .then(response => response.blob())
    .then(
        blob =>
        new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onloadend = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(blob);
        })
    );

const readFile = file => {
    return new Promise((resolve, reject) => {
        const fr = new FileReader();
        fr.onerror = reject;
        fr.onload = function() {
            resolve(fr.result);
        };
        fr.readAsDataURL(file);
    });
};

const fonts = [
    "Kanit",
    "Oswald",
    "Prompt",
    "Roboto",
    "Roboto Slab",
    "Lora",
    "Verdana",
    "Tahoma"
];



const app = new Vue({
    el: "#app",
    data: {
        url: document.getElementById("urlQR").value.toString(),
        qrCode: undefined,
        qrSize: 275,
    },
    mounted: async function() {
        const qrCode = new QRCode("qr-code", {
            text: this.url,
            width: this.qrSize,
            height: this.qrSize
        });
        this.qrCode = qrCode;
    },
    watch: {
        url: function(value) {
            this.qrCode.clear();
            this.qrCode.makeCode(value);
        }
    },
    methods: {
        updateQR: function(change) {
            if (this.qrSize <= 100 && change < 0) {
                return;
            }
            if (this.qrSize >= 500 && change > 0) {
                return;
            }

            this.qrSize += change;

            // Lol hack
            document.querySelector("#qr-code").innerHTML = "";
            this.qrCode = new QRCode("qr-code", {
                text: this.url,
                width: this.qrSize,
                height: this.qrSize
            });
        },
        exportCard: async () => {
            // Sửa phần DOM Node By Nhu (Từ #qr-code sang #card ở line 79 & line 80)
            await domtoimage.toPng(document.querySelector("#card")); // Lol font only work in 2nd times
            const dataUrl = await domtoimage.toPng(document.querySelector("#card"));

            const img = new Image();
            img.src = dataUrl;
            console.log(img);
            const link = document.createElement("a");
            link.download = "taotap-card.png";
            link.href = dataUrl;
            link.click();
        },
        exportPDF: async () => {
            const {
                jsPDF
            } = window.jspdf;

            await domtoimage.toPng(document.querySelector("#qr-code")); // Lol font only work in 2nd times
            const dataUrl = await domtoimage.toPng(document.querySelector("#qr-code"));

            const img = new Image();
            img.src = dataUrl;

            const doc = new jsPDF();
            const RATIO = 1.02;
            const WIDTH = 85.5 * RATIO;
            const HEIGHT = 54 * RATIO;
            doc.addImage(img, "JPEG", 15, 15, WIDTH, HEIGHT);
            doc.addImage(img, "JPEG", 15, 90, WIDTH, HEIGHT);

            doc.setFontSize(16);
            doc.setFont("courier", "bold");
            doc.text(`Chon "Fit to Paper" khi in nhe.`, 15, 160);

            doc.setLineWidth(3);
            doc.line(0, 0, 210, 0);
            doc.line(0, 0, 0, 297);
            doc.line(210, 0, 210, 297);
            doc.line(0, 297, 210, 297);
            doc.save("taotap.pdf");
        },
        setBackground: function(bg) {
            this.background = bg;
        }
    }
});