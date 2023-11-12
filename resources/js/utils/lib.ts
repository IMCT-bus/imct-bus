import { format } from 'date-fns';
import { ru } from 'date-fns/locale';

export function getRange(start: number, end: number) {
  return Array.from({ length: end - start + 1 }, (_, i) => start + i);
}

export function formatDateLong(date: string) {
  return format(new Date(date), 'EEEE, d MMMM', { locale: ru });
}

export function formatDateShort(date: string) {
  return format(new Date(date), 'E, d.MM', {locale: ru})
}