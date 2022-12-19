import {IProductVariant} from './product-variant/product-variant';

export interface IProduct {
  id: number;
  category_id: number;
  cover_image_id: number;
  name: string;
  sku: string;
  price: number;
  short_description: string;
  variants: IProductVariant[];
  additional_image_ids: number[];
}
