import * as THREE from 'three';
import SpriteText from 'three-spritetext';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls'
import {Modal, Toast} from 'bootstrap';

export class Visualise {
    public camera;
    public scene;
    public renderer;
    public controls;
    public ID;
    public data;
    public group;
    public addModal;
    public viewModal;
    public selected;
    public pointer;
    public raycaster;
    public API = '/api/';
    public headers;

    constructor(data) {
        const width = window.innerWidth;
        const height = window.innerHeight;

        this.data = data;
        this.camera = new THREE.PerspectiveCamera(60, width / height, 1, 21000);
        this.camera.position.z = 1000;

        this.scene = new THREE.Scene();
        this.scene.fog = new THREE.Fog(0x6393c4, 1500, 21000);

        this.pointer = new THREE.Vector2();
        this.raycaster = new THREE.Raycaster();

        //Renderer
        this.renderer = new THREE.WebGLRenderer();
        this.renderer.setPixelRatio(window.devicePixelRatio);
        this.renderer.setSize(width, height);
        this.renderer.setClearColor(0x6393c4, 1);

        document.body.appendChild(this.renderer.domElement);

        //Window resize
        var scope = this;

        function onWindowResize() {
            const width = window.innerWidth;
            const height = window.innerHeight;

            scope.camera.aspect = width / height;
            scope.camera.updateProjectionMatrix();
            scope.renderer.setSize(width, height);
        }

        //Events
        window.addEventListener('resize', onWindowResize);
        document.addEventListener('pointermove', function (event) {
            scope.onPointerMove(event)
        });
        document.addEventListener('mousedown', function (event) {
            scope.onPointerClick(event)
        });

        //Controls
        this.controls = new OrbitControls(this.camera, this.renderer.domElement);
        this.controls.autoRotate = true;
        this.controls.autoRotateSpeed = 1;

        //Init other functions
        this.animate(this);
        this.createSphere(this.data);
        this.openAddModal();
        this.addPhrase();
        this.deletePhrase();

        //@ts-ignore Const from blade script
        this.ID = MAGIC_ID;

        //Api
        this.headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
    }

    //Animate loop
    public animate(visualise: Visualise): void {
        requestAnimationFrame(() => {
            visualise.animate(visualise);
        });

        this.render();
    }

    //Render scene
    public render(): void {
        this.controls.update();
        this.renderer.render(this.scene, this.camera);
    }

    //Create text sprite object
    public createSprite(text, id = "") {
        const sprite = new SpriteText(text);
        sprite.backgroundColor = '#49c9d5';
        sprite.borderRadius = 3;
        sprite.padding = 4;
        sprite.fontWeight = 'bold';
        sprite.fontSize = 50;
        // @ts-ignore
        sprite.name = id;

        return sprite;
    }

    //Create sprites sphere
    public createSphere(data) {
        //Add group
        this.group = new THREE.Group();
        this.group.name = 'Sprites';

        //Add scene
        this.scene.add(this.group);

        var amount = data.length;
        var radius = 20 * amount;

        var offset = 2 / amount;
        var increment = Math.PI * (3 - Math.sqrt(5));
        var random = 1;
        var scope = this;

        data.forEach(function (magic, i) {
            const text = scope.createSprite(magic.title, magic.id);

            //Fibonacci algoritmas
            var y = ((i * offset) - 1) + (offset / 2);
            var distance = Math.sqrt(1 - Math.pow(y, 2));
            var phi = ((i + random) % amount) * increment;
            var x = Math.cos(phi) * distance;
            var z = Math.sin(phi) * distance;
            x = x * radius;
            y = y * radius;
            z = z * radius;

            // @ts-ignore
            text.position.set(x, y, z);
            // @ts-ignore
            text.scale.set(100, 30, 100);

            scope.group.add(text);
        });
    }

    //Open add phrase modal on click
    public openAddModal() {
        var addPhraseModal = document.getElementById('addPhraseModal');
        var addPhrase = document.getElementById('addPhrase');
        var modal = new Modal(addPhraseModal);

        addPhrase.addEventListener("click", modal.show);

        this.addModal = modal;
    }

    //Open phrase view modal function
    public openViewModal(id) {
        var viewPhraseModal = document.getElementById('viewPhraseModal');
        var modal = new Modal(viewPhraseModal);

        fetch(this.API + 'view-phrase/' + id,
            {
                headers: this.headers
            }
        )
            .then(response => response.json())
            .then(result => {
                document.getElementById('viewPhraseModalLabel').innerText = result.data.title;
                document.getElementById('viewPhraseModalBody').innerText = result.data.description;
                document.getElementById('phraseDelete').setAttribute("data-id", result.data.id);
                modal.show();
            });

        this.viewModal = modal;
    }

    //Add a new phrase
    public addPhrase() {
        var submitPhraseButton = document.getElementById('submitPhrase');
        var phraseErrorAlert = document.getElementById('phraseError');
        var toastEl = document.getElementById('addedToast');

        phraseErrorAlert.classList.add("d-none");

        var scope = this;
        var addModal = this.addModal;
        var API = this.API;

        submitPhraseButton.addEventListener("click", function () {
            var phrase = (<HTMLInputElement>document.getElementById('phrase'));
            var description = (<HTMLInputElement>document.getElementById('description'));

            if (phrase) {
                phraseErrorAlert.classList.add("d-none");

                fetch(API + 'add-phrase',
                    {
                        headers: scope.headers,
                        method: 'POST',
                        body: JSON.stringify(
                            {magic_id: scope.ID, phrase: phrase.value, description: description.value}
                        )
                    }
                )
                    .then(response => response.json())
                    .then(data => {
                        scope.removeSprites();

                        //Update with new
                        scope.data.push({title: phrase.value, id: data.id});
                        scope.createSphere(scope.data);

                        //Reset fields
                        phrase.value = '';
                        description.value = '';

                        new Toast(toastEl).show();
                    });

                addModal.hide();
            } else {
                phraseErrorAlert.classList.remove("d-none");
            }
        });
    }

    //Remove all sprites from scene
    public removeSprites() {
        var scene = this.scene;
        scene.traverse(function (child) {
            if (child.name == "Sprites") {
                scene.remove(child);
            }
        });
    }

    //Delete phrase on button click
    public deletePhrase() {
        var deleteButton = document.getElementById('phraseDelete');
        var toastEl = document.getElementById('deleteToast');

        var scope = this;

        deleteButton.addEventListener("click", function () {
            let phraseId = this.getAttribute('data-id');

            fetch(scope.API + 'delete-phrase/' + phraseId,
                {
                    headers: scope.headers,
                    method: 'DELETE'
                }
            )
                .then(response => response.json())
                .then(data => {
                    scope.removeSprites();

                    scope.data = scope.data.filter(function (elem) {
                        return elem.id != phraseId;
                    });

                    scope.createSphere(scope.data);

                    scope.closeViewModal();

                    new Toast(toastEl).show();
                });
        });
    }

    //Close view modal
    public closeViewModal() {
        this.viewModal.hide();
    }

    //Intersect on mouse move
    public onPointerMove(event) {
        if (this.selected) {
            this.selected.material.color.set('#49c9d5');
            this.selected = null;
        }

        const intersects = this.rayIntersect(this.group, event);

        if (intersects) {
            this.selected = intersects.object;
            this.selected.material.color.set('#e34578');
        }
    }

    //Intersect on mouse click
    public onPointerClick(event) {
        const intersects = this.rayIntersect(this.group, event);

        if (intersects) {
            var phraseId = intersects.object.name;
            this.openViewModal(phraseId);
        }
    }

    //Raycasting for mouse events
    public rayIntersect(object, event) {
        this.pointer.x = (event.clientX / window.innerWidth) * 2 - 1;
        this.pointer.y = -(event.clientY / window.innerHeight) * 2 + 1;
        this.raycaster.setFromCamera(this.pointer, this.camera);

        const intersects = this.raycaster.intersectObject(object, true);

        if (intersects.length > 0) {
            const res = intersects.filter(function (res) {
                return res && res.object;
            })[0];

            if (res && res.object) {
                return res;
            }
        }

        return null;
    }
}
