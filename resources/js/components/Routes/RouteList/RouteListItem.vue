<script setup lang="ts">
import { LocationSharp } from '@vicons/ionicons5';

type RouteListItemProps = {
  routeItem: Resources.RouteResource;
  onEdit: (id: number) => void;
  onDelete: (id: number) => void;
};

defineProps<RouteListItemProps>();
</script>

<template>
  <n-list-item>
    <n-thing :description="`Время начала: ${routeItem.starts_at}`">
      <template #header>
        {{ routeItem.name }}
      </template>
      <template #action>
        <div class="actions">
          <n-button size="small" ghost type="info" @click="onEdit(routeItem.id)">Редактировать</n-button>
          <n-button size="small" @click="onDelete(routeItem.id)">Удалить</n-button>
        </div>
      </template>
      <n-collapse>
        <n-collapse-item title="Полный маршрут" name="1">
          <n-timeline>
            <n-timeline-item v-for="stop in routeItem.stops" :content="stop.arrives_at ?? ''">
              <template #header>
                <n-space align="start" class="stop-link-container">
                  <n-icon :component="LocationSharp" color="#0168F9" size="16px" v-if="stop.link" />
                  <a v-if="stop.link" :href="stop.link" target="_blank" class="stop-link">{{ stop.name }}</a>
                  <span v-else class="stop-link">{{ stop.name }}</span>
                </n-space>
              </template>
            </n-timeline-item>
          </n-timeline>
        </n-collapse-item>
      </n-collapse>
    </n-thing>
  </n-list-item>
</template>
<style scoped lang="scss">
.actions {
  @include row;
  justify-content: flex-end;

  @include phone {
    * {
      flex-grow: 1;
    }
  }
}
.stop-link {
  font-weight: 400;
  font-size: 1rem;
  color: currentColor;
}
</style>
