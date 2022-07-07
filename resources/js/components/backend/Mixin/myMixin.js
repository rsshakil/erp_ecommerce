export default {
    data() {
        return {
            global_user_id: '',
            myLang: Globals,
            myTTL: 3600,
            BASE_URL: `${process.env.MIX_APP_URL}`,
            alert_icon: 'error',
            alert_title: 'Oops...',
            alert_text: 'Something went wrong!',
            alert_footer: 'May be internet or url problem',
            yes_btn: 'Yes, delete it!',
            cancel_btn: "Cancel",
            status: ['active', 'pending', 'rejected'],
            districts: [],
            thanas: [],
            areas: [],
            hubs: [],
            weight_lists: [],
            sortingData: [
                { count_num: 15 },
                { count_num: 25 },
                { count_num: 50 },
                { count_num: 100 },
                { count_num: 500 },
                { count_num: 1000 },
            ],
            parcelStatusItems: ['All', 'pending', 'picking', 'on_delivery', 'delivered', 'returned'],

        }
    },
    methods: {

        sweet_normal_alert() {
            Swal.fire({
                icon: this.alert_icon,
                title: this.alert_title,
                text: this.alert_text
            })
        },
        sweet_advance_alert() {
            Swal.fire({
                icon: this.alert_icon,
                title: this.alert_title,
                text: this.alert_text,
                footer: this.alert_footer
            })
        },
        delete_sweet() {
            this.alert_icon = 'warning'
            this.alert_title = 'Are you sure?'
            this.alert_text = "You won't be able to revert this!"
            var status = Swal.fire({
                icon: this.alert_icon,
                title: this.alert_title,
                text: this.alert_text,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            return status;
        },
        is_disabled(is_system = 0) {
            if (is_system == 0) {
                return true;
            } else {
                return false;
            }
        },
        getDistricts() {
            axios.post("get_districts")
                .then(({ data }) => {
                    this.districts = data.districts;
                    // console.log(this.districts);
                })
        },
        getHubs() {
            axios.post("get_hubs")
                .then(({ data }) => {
                    this.hubs = data.hubs;
                })
        },
        getThanaListByDistrctId(id) {
            axios.post("get_thanas", { district_id: id })
                .then(({ data }) => {
                    this.thanas = data.thanas;
                })
        },
        getAreaListByThanaId(id) {
            axios.post("get_areas", { thana_id: id })
                .then(({ data }) => {
                    this.areas = data.areas;
                })
        },
        getThanas($event) {
            this.form.thana = null
            this.form.area = null
            this.form.district = $event
            if (this.$route.name == "add-merchant" || this.$route.name == "edit-merchant" || this.$route.name == "add-hubs" || this.$route.name == "edit-hubs") {
                this.inputData.district_id = $event.district_id;
            }
            axios.post("get_thanas", { district_id: $event.district_id })
                .then(({ data }) => {
                    this.thanas = data.thanas;
                })
        },
        getAreas($event) {
            this.form.area = null
            this.form.thana = $event
            if (this.$route.name == "add-merchant" || this.$route.name == "edit-merchant" || this.$route.name == "add-hubs" || this.$route.name == "edit-hubs") {
                this.inputData.thana_id = $event.thana_id
            }
            axios.post("get_areas", { thana_id: $event.thana_id })
                .then(({ data }) => {
                    this.areas = data.areas;
                })
        },
        setArea($event) {
            this.form.area = $event
            if (this.$route.name == "add-merchant" || this.$route.name == "edit-merchant" || this.$route.name == "add-hubs" || this.$route.name == "edit-hubs") {
                this.inputData.area_id = $event.area_id;
            }

        },
        setHub($event) {
            this.inputData.hub_id = $event.hub_id;
        },
        getWeightPack(charge_list_id) {
            axios.post("get_weight_list", { charge_list_id: charge_list_id })
                .then(({ data }) => {
                    console.log(data)
                    this.weight_lists = data.weight_lists;
                })
        },
        setWithExpiry(key, value, ttl) {
            const now = new Date()
                // `item` is an object which contains the original value
                // as well as the time when it's supposed to expire
            const item = {
                value: value,
                expiry: now.getTime() + (ttl * 1000),
            }
            localStorage.setItem(key, JSON.stringify(item))
        },
        getWithExpiry(key) {
            const itemStr = localStorage.getItem(key)
                // if the item doesn't exist, return null
            if (!itemStr) {
                return null
            }
            const item = JSON.parse(itemStr)
            const now = new Date()
                // compare the expiry time of the item with the current time
            if (now.getTime() > item.expiry) {
                // If the item is expired, delete the item from storage
                // and return null
                localStorage.removeItem(key)
                return null
            }
            return item.value
        },
        sweet_normal_alert() {
            Swal.fire({
                icon: this.alert_icon,
                title: this.alert_title,
                html: this.alert_text,
                confirmButtonText: "OK"
            });
        },
        sweet_advance_alert() {
            Swal.fire({
                icon: this.alert_icon,
                title: this.alert_title,
                html: this.alert_text,
                footer: this.alert_footer
            });
        },
        delete_sweet() {
            this.alert_icon = "warning";
            this.alert_title = "Are you sure?";
            this.alert_text = "You won't be able to revert this!";
            var status = Swal.fire({
                icon: this.alert_icon,
                title: this.alert_title,
                html: this.alert_text,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            });
            return status;
        },
        confirm_sweet() {
            var status = Swal.fire({
                icon: this.alert_icon,
                title: this.alert_title,
                html: this.alert_text,
                showCancelButton: true,
                cancelButtonText: this.cancel_btn,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: this.yes_btn
            });
            return status;
        },
        downloadFromUrl(data) {
            const link = document.createElement("a");
            link.href = data.file_url;
            link.setAttribute("download", data.file_name); //ここらへんは適当に設定する
            document.body.appendChild(link);
            link.click();
        },
        logout() {
            localStorage.removeItem("user")
            localStorage.removeItem("Roles")
            localStorage.removeItem("Permissions")
            localStorage.removeItem("token")
            this.$router.push({ name: 'admin_login' })
            Fire.$emit('header_nav');

        }
    },
    filters: {
        strCheck: function(str) {
            var my_str = '';
            if (str) {
                my_str = str
            }
            return my_str;
        },
        capitalize: function(value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    }
};