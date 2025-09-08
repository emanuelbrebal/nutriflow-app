export function formatCPF(value: string): string {
  if (!value) return ''
  value = value.replace(/\D/g, '') 
  value = value.slice(0, 11) 
  return value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4')
}