import { FormGroup } from '@angular/forms';

export function ImageUrl(controlName: string) {
    return (formGroup: FormGroup) => {
        const url = formGroup.controls[controlName].value;

        if (formGroup.controls[controlName].errors && !formGroup.controls[controlName].errors.invalidImg) {
            // return if another validator has already found an error
            return;
        }

        if (!url.match(/\.(jpeg|jpg|gif|png)$/)) {
            formGroup.controls[controlName].setErrors({ invalidImg: true });
        } else {
            formGroup.controls[controlName].setErrors(null);
        }
    }
}
