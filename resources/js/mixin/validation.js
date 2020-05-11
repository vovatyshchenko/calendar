
import { validationMixin } from 'vuelidate'
import { required, email } from 'vuelidate/lib/validators'
export default {
    mixins: [validationMixin],
    data(){
        return{

        }
    },
    validations: {
        name: { required},
        guests: {required},
        email: { required, email },
        select: { required },
        location: { required },
        description: { required },
        dateStart:{required},
        dateEnd:{required},
        checkbox: {
            checked (val) {
                return val
            },
        },
    },
    computed: {
        computedDateFormattedMomentjs () {
            return this.dateStart ? moment(this.dateStart).format('D MMM  YYYY') : ''
        },
        computedDateFormattedDatefns () {
            return this.dateStart ? format(this.dateStart, 'D MMM   YYYY') : ''
        },
        computedDateFormattedMomentjsForEnd () {
            return this.dateEnd ? moment(this.dateEnd).format('D MMM  YYYY') : ''
        },
        computedDateFormattedDatefnsForEnd () {
            return this.dateEnd ? format(this.dateEnd, 'D MMM   YYYY') : ''
        },
        checkboxErrors () {
            const errors = []
            if (!this.$v.checkbox.$dirty) return errors
            !this.$v.checkbox.checked && errors.push('You must agree to continue!')
            return errors
        },
        selectErrors () {
            const errors = []
            if (!this.$v.select.$dirty) return errors
            !this.$v.select.required && errors.push('Item is required')
            return errors
        },
        dateStartErrors () {
            const errors = []
            if (!this.$v.select.$dirty) return errors
            !this.$v.select.required && errors.push('Item is required')
            return errors
        },
        nameErrors () {
            const errors = []
            if (!this.$v.name.$dirty) return errors
            !this.$v.name.required && errors.push(' ')
            return errors
        },
        guestsErrors () {
            const errors = []
            if (!this.$v.guests.$dirty) return errors
            !this.$v.guests.required && errors.push(' ')
            return errors
        },
        emailErrors () {
            const errors = []
            if (!this.$v.email.$dirty) return errors
            !this.$v.email.email && errors.push('Must be valid e-mail')
            !this.$v.email.required && errors.push()
            return errors
        },
        locationErrors () {
            const errors = []
            if (!this.$v.location.$dirty) return errors
            !this.$v.location.required && errors.push(' ')
            return errors
        },
        descriptionErrors () {
            const errors = []
            if (!this.$v.description.$dirty) return errors
            !this.$v.description.required && errors.push(' ')
            return errors
        },
        globalErrorMessasge(){
            if(this.nameErrors.length>0
                ||this.guestsErrors.length>0
                ||this.locationErrors.length>0
                ||this.descriptionErrors.length>0
            )
            {
                return true;
            }
            return false;
        }
    },
}
