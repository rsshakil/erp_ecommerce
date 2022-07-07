import { forEach } from "lodash";


export default {
    data() {
        return {
            url: `${process.env.MIX_APP_URL}`, //window.location.origin,
            isEdit: false,
            isEditItem: false,
            isFile: false,
            isAddItem: true,
            isPagination: true,
            isSingleItem: false,
            isDateSearch: false,
            isSamePage: false,
            isSearch: false,
            isActionBtn: true,
            isEditBtn: true,
            isDelBtn: true,
            isSearchBox: true,
            isMerchantFilter: true,
            isStatusList: true,
            isFilterByStatus: true,
            backUrl: '',
            isImage: '',
            showImage: '',
            notReset: {},
            cardTitle: "",
            inputData: {},
            error: {},
            dataList: {},
            excelFields: {},
            excelTitle: {},
            isDownload: true,
            isSorting: true,
            searchApi: null,
            generalApi: null,
            getApi: null,
            postApi: null,
            patchApi: null,
            editApi: null,
            search: "",
            showPagination: true,
            tableContent: "",
            columnsHead: [],
            columnsBody: [],
            columnsBodyExtra: [],
            vColumns: [],
            customerList: [],
            isDataSearching: false,
            dataSearchingApi: null,
            searchForm: {},
            sortingForm: {},
            imageData:''
        }
    },

    created() {

        this.generalSettings()

        jQuery(document).on('keyup', 'form input', function(e) {


            jQuery(this).removeClass('is-invalid')
            if (jQuery(this).val() != '') {
                jQuery(this).addClass('is-valid')
                jQuery(this).next().remove()
            } else {
                jQuery(this).removeClass('is-valid')
            }

        })

    },
    mounted() {
        this.getDataList()
    },
    methods: {
        updateItem(item) {

            let _this = this;
            let api = this.generalApi != null ? this.generalApi : this.postApi
            let patch_api = this.url + 'api/' + api + '/' + item.id + '/?optional_id=' + item.id

            axios.delete(patch_api, { data: item }).then(response => {

                    this.toastMessage('success', response.data.message)
                })
                .catch(error => {

                    if (error.response.status == 422) {
                        this.error = error.response.data.errors
                       
                        console.log('sweet alter not working');
                        $.each(error.response.data.errors, function(item, index) {
                            let input = jQuery(document).find('input[name="' + item + '"]')
                            let inputAfter = jQuery(document).find('input[name="' + item + '"] + span')

                            input.addClass('is-invalid')

                            inputAfter.remove()
                            input.after('<span class="text-danger">' + error.response.data.errors[item] + '</span>')

                            

                        })



                    }
                })
        },
        generalSettings() {

            if (this.$route.params.id) {
                this.isEdit = true
                axios.get(this.url + 'api' + this.$route.path)
                    .then(res => {

                        let image = this.isImage
                            // console.log(typeof(res.data.data[image]));
                        if (typeof(res.data.data[image]) == 'object') {
                            var i = 0;
                            // res.data.data[image].forEach(image => {
                            //     if(image.name){
                            //         // this.showImage +=
                            //         //'<a href="#" data-imageid="'+image.id+'" class="text-danger deleteImage" style="position:absolute; margin-left:10px; z-index:999; "><i class="fa fa-trash"></i></a><img style="width:100px; height:100px; position:relative; margin:10px; padding:5px;" src="'+res.data.data['image_path']+image.name+'">'
                            //     }

                            // })
                        } else {
                            this.showImage = '<img style="width:150px; height:150px;" src="' + res.data.data[image] + '">'
                        }
                        this.inputData = res.data.data;
                        if (this.$route.name == 'merchants' || this.$route.name == 'add-merchant' || this.$route.name=='edit-merchant') {
                           
                            this.inputData.district_ids = res.data.data.districtInfo
                            this.getThanaListByDistrctId(res.data.data.district_id)
                            this.inputData.thana_ids = res.data.data.thanaInfo
                            this.getAreaListByThanaId(res.data.data.thana_id)
                            this.inputData.area_ids = res.data.data.areaInfo
                        }
                        
                        // console.log(this.inputData)

                    })
            }

            //getCustomerList
            axios.get(this.url + "api/get_all_contact_list?client_id="+Globals.user_info_client_id)
                    .then(({
                        data
                    }) => {
                        console.log(data);
                        this.customerList = data.contact_list;
                    })
                    .catch(() => {
                        console.log("Error...");
                    });

        },

        toastMessage(type, message, icon, position, actionIcon) {
            var toast = null;
            if (type == 'success') {
                toast = this.$toasted.success
            } else if (type == 'info') {
                toast = this.$toasted.info
            } else if (type == 'error') {
                toast = this.$toasted.error
            } else if (type == 'warning') {
                toast = this.$toasted.error
            }
            toast(message, {
                // theme:'bubble',
                icon: icon ? icon : 'check',
                position: position ? position : 'top-right',
                iconPack: 'fontawesome',
                icon: icon ? icon : 'check',
                duration: 3000,
                action: {
                    icon: actionIcon ? actionIcon : 'times',
                    class: 'text-white',
                    onClick: (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                },
            });
        },

        previewImage: function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        },
        processData() {

            let api = this.generalApi != null ? this.generalApi : this.postApi
            let post_api = this.url + 'api/' + api
            let patch_api = this.url + 'api/' + api + '/' + this.inputData.id

            let form = jQuery(document).find('.form');
            let formData = new FormData($(form)[0])

            if (this.isEdit == true) {
                formData.append('_method', 'PUT')
                this.inputData._method = 'PUT'
            }

            let getdata = this.isFile == true ? formData : this.inputData

            let axiosRoute = this.isEdit == false ? axios.post(post_api, getdata) : axios.post(patch_api, getdata)

            axiosRoute.then(response => {
                    // if (this.isSamePage == false) {
                    //     let push_url = '/' + api
                    //     this.$router.push(push_url)
                    // } else {
                    //     if (this.isSamePage == false) {

                    //         this.resetForm()
                    //     } else {
                    //         this.dataList = response.data
                    //     }
                    // }
                    let toastClass=  typeof response.data.class_name!='undefined'?response.data.class_name:typeof response.data.status!='undefined'?'success':'success';
                    this.toastMessage(toastClass, response.data.message)
                    if (response.data.status == 1) {
                        let push_url = '/' + api
                        this.$router.push(push_url)
                    }else{
                        if(this.isEdit == false){
                            this.resetForm()
                        }
                    }
                    
                })
                .catch(error => {
                    // console.log(error.response.status)
                    
                    if (error.response) {
                    if (error.response.status == 422) {
                        this.error = error.response.data.errors
                            
                        $.each(error.response.data.errors, function(item, index) {
                            let input = jQuery(document).find('input[name="' + item + '"]')
                            let inputAfter = jQuery(document).find('input[name="' + item + '"] + span')
                           
                            input.addClass('is-invalid')

                            inputAfter.remove()
                            input.after('<span class="text-danger">' + error.response.data.errors[item] + '</span>')

                        })



                    }
                    }
                })
        },



        getDataList(page = 1) {
            let api = this.generalApi != null ? this.generalApi : this.getApi

            let search = "";

            if ((this.searchForm.search && this.searchForm.search != 'undefined')) {

                search = this.searchForm.search

            } else {

                search = false

            }

            let start_date = ""
            let end_date = ""

            if((this.isDateSearch && this.searchForm.start_date != 'undefined' && this.searchForm.end_date != 'undefined')){
                start_date = this.searchForm.start_date;
                end_date = this.searchForm.end_date;
            }

            let sorting_item = ""

            if (this.sortingForm.sorting_item && this.sortingForm.sorting_item != 'undefined') {

                sorting_item = this.sortingForm.sorting_item
                page = (sorting_item - sorting_item) + 1

            } else {

                sorting_item = false

            }
           
           




            let api_path = this.url + 'api/' + api + '?page=' + page + '&search=' + search + '&start_date=' + start_date + '&end_date=' + end_date + '&sorting=' + sorting_item + '&client_id=' + Globals.user_info_client_id
            //let api_path = this.url + 'api/' + api;

            axios.get(api_path)
                .then(response => {

                    if (response.status == 200) {

                        this.dataList = response.data
                        console.log(this.dataList);
                        

                    }


                })
                .catch(error => {
                    console.log('errorOccurrred');
                    if (error.response !== undefined && error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        this.toastMessage('error', error, 'check', '', 'times')
                    }
                })
                .finally(() => {

                })
        },



        showEditForm(id) {
            let api = this.generalApi != null ? this.generalApi : this.getApi
            this.$router.push({ path: api + '/' + id });

        },

        dialogConfig() {
            let message = "Are you sure?";

            let options = {
                html: false, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
                loader: false, // set to true if you want the dailog to show a loader after click on "proceed"
                reverse: false, // switch the button positions (left to right, and vise versa)
                okText: 'Delete',
                cancelText: 'Close',
                animation: 'bounce', // Available: "zoom", "bounce", "fade"
                type: 'basic', // coming soon: 'soft', 'hard'
                verification: 'continue', // for hard confirm, user will be prompted to type this to enable the proceed button
                verificationHelp: 'Type "[+:verification]" below to confirm', // Verification help text. [+:verification] will be matched with 'options.verification' (i.e 'Type "continue" below to confirm')
                clicksCount: 3, // for soft confirm, user will be asked to click on "proceed" btn 3 times before actually proceeding
                backdropClose: false, // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
                customClass: '' // Custom class to be injected into the parent node for the current dialog instance
            };

            let config = {
                message: message,
                options: options
            }

            return config


        },

        /* This delete function work for multiple image delete with relational data and it can
        also delete single image item form it's table */

        deleteItem(i, j) {

            /*   j = When you have to delete a single image from multiple image during edit
               then this 'j' parameter passed image id and it helps to delete image item from it's table*/

            let message = this.dialogConfig().message
            let options = this.dialogConfig().options

            this.$dialog.confirm(message, options)

            .then(res => {
                    let api = this.generalApi != null ? this.generalApi : this.getApi

                    let api_path = this.url + 'api/' + api + '/' + i + '?optional_id=' + j

                    axios.delete(api_path)
                        .then(response => {

                            this.toastMessage(response.data.class_name, response.data.message)
                            this.getDataList()
                            this.generalSettings()

                        })
                        .catch(error => {
                            this.toastMessage('error', error.response.data.message, 'times')
                        })

                })
                .catch(error => {
                    this.toastMessage('success', 'Thanks for keeping me safe!')
                });

        },

        resetForm() {
            this.inputData = {}
            this.inputData.client_id = Globals.user_info_client_id;
            let field = this.notReset.field
            let value = this.notReset.value
            this.inputData[field] = value
        }


    }
}