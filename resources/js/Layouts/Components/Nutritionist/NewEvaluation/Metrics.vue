<script setup lang="ts">
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select";
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';

</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle>Circunferências (cm)</CardTitle>
        </CardHeader>
        <CardContent class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="space-y-2"><Label for="neck">Pescoço</Label><Input id="neck" type="number" step="0.1"
                    placeholder="38.5" /></div>
            <div class="space-y-2"><Label for="chest">Tórax</Label><Input id="chest" type="number" step="0.1"
                    placeholder="95.0" /></div>
            <div class="space-y-2"><Label for="waist">Cintura</Label><Input id="waist" type="number" step="0.1"
                    placeholder="82.0" /></div>
            <div class="space-y-2"><Label for="abdomen">Abdômen</Label><Input id="abdomen" type="number" step="0.1"
                    placeholder="85.0" /></div>
            <div class="space-y-2"><Label for="hip">Quadril</Label><Input id="hip" type="number" step="0.1"
                    placeholder="102.0" /></div>
            <div class="space-y-2"><Label for="arm_relaxed">Braço</Label><Input id="arm_relaxed" type="number"
                    step="0.1" placeholder="33.0" /></div>
            <div class="space-y-2"><Label for="thigh">Coxa</Label><Input id="thigh" type="number" step="0.1"
                    placeholder="58.0" /></div>
            <div class="space-y-2"><Label for="calf">Panturrilha</Label><Input id="calf" type="number" step="0.1"
                    placeholder="39.0" /></div>
        </CardContent>
    </Card>

    <Card>
        <CardHeader>
            <CardTitle>Dobras Cutâneas (mm)</CardTitle>
        </CardHeader>
        <CardContent class="space-y-4">
            <div class="w-full md:w-1/2 space-y-2">
                <Label for="skinfold_protocol">Protocolo de Cálculo</Label>
                <Select default-placeholder="pollock7">
                    <SelectTrigger id="skinfold_protocol">
                        <SelectValue placeholder="Selecione o protocolo" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="pollock7">Pollock 7 Dobras</SelectItem>
                        <SelectItem value="pollock3">Pollock 3 Dobras</SelectItem>
                        <SelectItem value="guedes3">Guedes 3 Dobras</SelectItem>
                    </SelectContent>
                </Select>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="space-y-2"><Label for="triceps">Tríceps</Label><Input id="triceps" type="number" step="0.1"
                        placeholder="15" /></div>
                <div class="space-y-2"><Label for="subscapular">Subescapular</Label><Input id="subscapular"
                        type="number" step="0.1" placeholder="22" /></div>
                <div class="space-y-2"><Label for="chest_pectoral">Peitoral</Label><Input id="chest_pectoral"
                        type="number" step="0.1" placeholder="18" /></div>
                <div class="space-y-2"><Label for="midaxillary">Axilar Média</Label><Input id="midaxillary"
                        type="number" step="0.1" placeholder="20" /></div>
                <div class="space-y-2"><Label for="suprailiac">Supra-ilíaca</Label><Input id="suprailiac" type="number"
                        step="0.1" placeholder="25" /></div>
                <div class="space-y-2"><Label for="abdominal_skinfold">Abdominal</Label><Input id="abdominal_skinfold"
                        type="number" step="0.1" placeholder="30" /></div>
                <div class="space-y-2"><Label for="thigh_skinfold">Coxa</Label><Input id="thigh_skinfold" type="number"
                        step="0.1" placeholder="28" /></div>
            </div>
        </CardContent>
    </Card>


</template>