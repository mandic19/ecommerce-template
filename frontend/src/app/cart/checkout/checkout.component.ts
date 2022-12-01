import {Component, EventEmitter, Input, OnDestroy, OnInit, Output} from '@angular/core';
import {Subscription} from "rxjs";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {ICartItem} from "../item/cart-item";
import {OrderService} from "../../order/services/order.service";
import {IOrder} from "../../order/order";

@Component({
  selector: 'ecm-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit, OnDestroy {
  orderSub!: Subscription;
  checkoutForm: FormGroup;
  @Input() items: ICartItem[];
  @Output() backClicked: EventEmitter<string> = new EventEmitter<string>();
  @Output() checkoutCompleted: EventEmitter<string> = new EventEmitter<string>();
  errors: object;

  isSubmitted: boolean = false;
  order: IOrder;

  constructor(private fb: FormBuilder, private orderService: OrderService) {
  }

  ngOnInit(): void {
    this.checkoutForm = this.fb.group({
      name: ['', [Validators.required]],
      address: ['', Validators.required],
      phone: ['', Validators.required],
      notes: ''
    });
  }

  ngOnDestroy(): void {
    this.orderSub?.unsubscribe();
  }

  onBackClick(): void {
    this.backClicked.emit();
  }

  onSubmit(): void {
    this.isSubmitted = true;

    if(this.checkoutForm.invalid) {
      return;
    }

    let formParams = this.checkoutForm.value;
    let orderItems = this.items.map(i => {
      return {
        product_id: i.product_id,
        product_variant_id: i.product_variant_id || null,
        quantity: i.quantity
      };
    });

    let body = {...{order_items: orderItems}, ...formParams};

    this.orderSub = this.orderService.createOrder(body).subscribe({
      next: response => {
        this.order = {...response.data};
        this.checkoutCompleted.emit();
      },
      error: err => this.handleError(err)
    });
  }

  handleError(err): void {
    if(err?.error?.errors instanceof Object)
    this.errors = err?.error?.errors;
  }

  isInvalidField(fieldName: string): boolean {
    let formControl = this.checkoutForm.get(fieldName);
    return this.isSubmitted && !formControl.valid;
  }
}
