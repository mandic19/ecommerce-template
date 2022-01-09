export interface ICategory {
  id: number,
  parent_category_id: number,
  cover_image_id: number,
  name: string,
  description: string,
  order: number,
  sub_categories: ICategory[]
}
