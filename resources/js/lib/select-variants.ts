import { cva, type VariantProps } from 'class-variance-authority'

export const selectVariants = cva(
  'flex w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background transition-all focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50',
  {
    variants: {
      variant: {
        default: 'hover:border-primary/50',
        destructive: 'border-destructive focus:ring-destructive/50',
        outline: 'border-border bg-transparent hover:border-primary/50',
        ghost: 'border-transparent hover:bg-accent hover:text-accent-foreground'
      },
      size: {
        default: 'h-10',
        sm: 'h-8',
        lg: 'h-12'
      }
    },
    defaultVariants: {
      variant: 'default',
      size: 'default'
    }
  }
)

export type SelectVariants = VariantProps<typeof selectVariants>