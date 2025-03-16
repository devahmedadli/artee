@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mb-4 mt-5">
                <div class="card my-5">
                    <div class="card-body">
                        <canvas id="cardCanvas" width="250" height="400" class="border shadow-sm"></canvas>
                        <div class="mt-3 d-flex gap-2">
                            <button class="btn btn-primary" id="downloadBtn">
                                <i class="fas fa-download me-1"></i>
                            </button>
                            <button class="btn btn-success" id="saveBtn">
                                <i class="fas fa-cloud-upload-alt me-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.2.4/fabric.min.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const BusinessCard = {
                        canvas: null,
                        config: {
                            bgColor: '{{ $bgColor ?? "#ffffff" }}',
                            textColor: '{{ $textColor ?? "#000000" }}',
                            imageUrl: '{{ $imageUrl ?? "" }}',
                            backgroundImageUrl: '{{ $backgroundImageUrl ?? asset('assets/imgs/bg.jpg') }}',
                            data: @json($data ?? ['John Doe', 'Software Engineer', '12344342']),
                            socialLinks: @json($socialLinks ?? ['facebook' => 'facebook.com', 'twitter' => 'twitter.com', 'instagram' => 'instagram.com']),
                            dpi: 300 // High resolution setting
                        },
                        
                        init: function() {
                            // Create canvas with standard dimensions first
                            const displayWidth = 250;
                            const displayHeight = 400;
                            
                            this.canvas = new fabric.Canvas('cardCanvas', {
                                backgroundColor: this.config.bgColor,
                                width: displayWidth,
                                height: displayHeight
                            });
                            
                            // Set physical dimensions of the canvas element
                            const canvasEl = document.getElementById('cardCanvas');
                            canvasEl.width = displayWidth;
                            canvasEl.height = displayHeight;
                            canvasEl.style.width = displayWidth + 'px';
                            canvasEl.style.height = displayHeight + 'px';
                            
                            console.log('Business Card initialized with config:', this.config);
                            this.createCard();
                            
                            // Make sure all event listeners are properly set up
                            document.getElementById('downloadBtn').addEventListener('click', this.exportCard.bind(this));
                            document.getElementById('saveBtn').addEventListener('click', this.uploadCard.bind(this));
                        },
                        
                        createCard: function() {
                            this.canvas.clear();
                            this.canvas.setBackgroundColor(this.config.bgColor, this.canvas.renderAll.bind(this.canvas));
                            
                            // Add elements in sequence with proper delays to ensure loading
                            this.addBackgroundImage();
                            
                            // Use setTimeout to ensure background is loaded before adding other elements
                            setTimeout(() => {
                                this.addLogo();
                                
                                // Add data fields and social links after logo is loaded
                                setTimeout(() => {
                                    this.addDataFields();
                                    this.addSocialLinks();
                                    this.canvas.renderAll();
                                }, 300);
                            }, 300);
                        },
                        
                        addBackgroundImage: function() {
                            const backgroundImageUrl = this.config.backgroundImageUrl;
                            if (backgroundImageUrl) {
                                console.log('Loading background image from URL:', backgroundImageUrl);
                                fabric.Image.fromURL(backgroundImageUrl, (img) => {
                                    if (!img) {
                                        console.error('Failed to load background image:', backgroundImageUrl);
                                        return;
                                    }
                                    
                                    const canvasWidth = this.canvas.width;
                                    const canvasHeight = this.canvas.height;
                                    
                                    // Calculate proper scaling to fill the canvas
                                    const scaleX = canvasWidth / img.width;
                                    const scaleY = canvasHeight / img.height;
                                    const scale = Math.max(scaleX, scaleY);
                                    
                                    // Center the image
                                    const left = (canvasWidth - img.width * scale) / 2;
                                    const top = (canvasHeight - img.height * scale) / 2;
                                    
                                    img.set({
                                        left: left,
                                        top: top,
                                        scaleX: scale,
                                        scaleY: scale,
                                        selectable: false,
                                        evented: false,
                                        opacity: 0.2 // Lighter background
                                    });
                                    
                                    this.canvas.add(img);
                                    this.canvas.sendToBack(img);
                                    this.canvas.renderAll();
                                }, { crossOrigin: 'anonymous' });
                            }
                        },
                        
                        addLogo: function() {
                            const imageUrl = this.config.imageUrl;
                            if (imageUrl) {
                                console.log('Loading logo from URL:', imageUrl);
                                // Center the logo at the top for vertical layout
                                this.loadImage(imageUrl, {
                                    left: (this.canvas.width / 2) - 50,
                                    top: 30,
                                    width: 100,
                                    height: 100,
                                    selectable: true,
                                    movable: true
                                });
                                this.logoAdded = true;
                            } else {
                                // Add a placeholder if no logo
                                const text = new fabric.Text('LOGO', {
                                    left: this.canvas.width / 2,
                                    top: 50,
                                    fontSize: 24,
                                    fontWeight: 'bold',
                                    fill: this.config.textColor,
                                    originX: 'center',
                                    textAlign: 'center'
                                });
                                this.canvas.add(text);
                                this.logoAdded = true;
                            }
                        },
                        
                        loadImage: function(url, options = {}) {
                            if (!url) return;
                            
                            // Add a placeholder while loading
                            const placeholder = new fabric.Circle({
                                left: options.left || 20,
                                top: options.top || 20,
                                radius: (options.width || 80) / 2,
                                fill: '#f0f0f0',
                                stroke: '#cccccc',
                                strokeWidth: 1
                            });
                            this.canvas.add(placeholder);
                            
                            fabric.Image.fromURL(url, (img) => {
                                if (!img) {
                                    console.error('Failed to load image:', url);
                                    return;
                                }
                                
                                this.canvas.remove(placeholder);
                                
                                // Calculate center position
                                const centerX = options.left + (options.width / 2);
                                const centerY = options.top + (options.height / 2);
                                
                                img.set({
                                    originX: 'center',
                                    originY: 'center',
                                    left: centerX,
                                    top: centerY,
                                    selectable: true,
                                    movable: true,
                                    hasControls: true,
                                    hasBorders: true,
                                    cornerColor: 'rgba(0,0,255,0.5)',
                                    cornerSize: 10,
                                    transparentCorners: false,
                                    borderColor: 'rgba(0,0,255,0.5)',
                                    borderScaleFactor: 2
                                });
                                
                                // Scale the image to fit the desired dimensions
                                if (options.width && options.height) {
                                    const scaleX = options.width / img.width;
                                    const scaleY = options.height / img.height;
                                    const scale = Math.min(scaleX, scaleY);
                                    img.scale(scale);
                                }
                                
                                this.canvas.add(img);
                                this.canvas.renderAll();
                                
                                // Remove the automatic selection of the image on load
                                // this.canvas.setActiveObject(img);
                            }, { crossOrigin: 'anonymous' });
                        },
                        
                        addDataFields: function() {
                            // For vertical layout, center align text
                            const centerX = this.canvas.width / 2;
                            let yPosition = this.logoAdded ? 150 : 50;
                            
                            if (Array.isArray(this.config.data) && this.config.data.length > 0) {
                                // Add name with larger font
                                const firstItem = this.config.data[0];
                                const nameText = new fabric.Text(firstItem, {
                                    left: centerX,
                                    top: yPosition,
                                    fontSize: 28,
                                    fontWeight: 'bold',
                                    fill: this.config.textColor,
                                    originX: 'center',
                                    textAlign: 'center'
                                });
                                this.canvas.add(nameText);
                                yPosition += 40;
                                
                                // Add other data fields
                                for (let i = 1; i < this.config.data.length; i++) {
                                    const dataText = new fabric.Text(this.config.data[i], {
                                        left: centerX,
                                        top: yPosition,
                                        fontSize: 20,
                                        fill: this.config.textColor,
                                        originX: 'center',
                                        textAlign: 'center'
                                    });
                                    this.canvas.add(dataText);
                                    yPosition += 30;
                                }
                            }
                            
                            this.currentYPosition = yPosition + 30;
                        },
                        
                        addSocialLinks: function() {
                            let yPosition = this.currentYPosition;
                            const centerX = this.canvas.width / 2;
                            
                            if (this.config.socialLinks && typeof this.config.socialLinks === 'object') {
                                // Add divider line
                                const divider = new fabric.Line([30, yPosition, this.canvas.width - 30, yPosition], {
                                    stroke: this.config.textColor,
                                    strokeWidth: 2,
                                    opacity: 0.5
                                });
                                this.canvas.add(divider);
                                
                                yPosition += 25;
                                
                                // Add social links
                                for (const [platform, url] of Object.entries(this.config.socialLinks)) {
                                    const displayText = url;
                                    const socialText = new fabric.Text(displayText, {
                                        left: centerX,
                                        top: yPosition,
                                        fontSize: 16,
                                        fill: this.config.textColor,
                                        originX: 'center',
                                        textAlign: 'center'
                                    });
                                    
                                    this.canvas.add(socialText);
                                    yPosition += 25;
                                }
                            }
                        },
                        
                        exportCard: function() {
                            try {
                                // Set a much higher DPI for export
                                const exportDpi = 600; // Increased from 300 to 600 DPI
                                const scaleFactor = exportDpi / 96; // Standard screen DPI is 96
                                
                                const dataURL = this.canvas.toDataURL({
                                    format: 'png',
                                    quality: 1,
                                    multiplier: scaleFactor // This significantly increases the resolution
                                });
                                
                                console.log('Exporting high-resolution image at ' + exportDpi + ' DPI');
                                
                                const link = document.createElement('a');
                                link.href = dataURL;
                                link.download = 'business_card_highres.png';
                                link.click();
                            } catch (error) {
                                console.error('Error exporting card:', error);
                                alert('Failed to export card. Please try again.');
                            }
                        },
                        
                        uploadCard: function() {
                            try {
                                const dataURL = this.canvas.toDataURL({
                                    format: 'png',
                                    quality: 1,
                                    multiplier: this.config.dpi / 96 // Upload at high resolution
                                });
                                
                                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                                
                                if (!csrfToken) {
                                    alert('CSRF token not found. Please refresh the page and try again.');
                                    return;
                                }
                                
                                const saveBtn = document.getElementById('saveBtn');
                                const originalText = saveBtn.innerHTML;
                                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Saving...';
                                saveBtn.disabled = true;
                                
                                fetch('/upload-business-card', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({ image: dataURL })
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if(data.success) {
                                        alert('Card uploaded successfully!');
                                    } else {
                                        alert('Error uploading card: ' + (data.message || 'Unknown error'));
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Error uploading card: ' + error.message);
                                })
                                .finally(() => {
                                    saveBtn.innerHTML = originalText;
                                    saveBtn.disabled = false;
                                });
                            } catch (error) {
                                console.error('Error preparing card for upload:', error);
                                alert('Failed to prepare card for upload. Please try again.');
                            }
                        }
                    };
                    
                    BusinessCard.init();
                });
            </script>
        </div>
    </div>
@endsection
