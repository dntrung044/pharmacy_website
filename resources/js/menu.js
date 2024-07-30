import {
  mdiAccountGroup,
  mdiInformationOutline,
  mdiSilverware,
  mdiCart,
  mdiPost,
} from '@mdi/js'

export default [
  {
    route: '/admin/about-us',
    icon: mdiInformationOutline,
    label: 'About Us'
  },
  {
    route: '/admin/products',
    icon: mdiSilverware,
    label: 'Product'
  },
  {
    route: '/admin/blog',
    icon: mdiPost,
    label: 'Blog'
  },
  {
    route: '/admin/transactions',
    icon: mdiCart,
    label: 'Transactions'
  },
  {
    route: '/admin/profile',
    icon: mdiAccountGroup,
    label: 'Users'
  },
]
