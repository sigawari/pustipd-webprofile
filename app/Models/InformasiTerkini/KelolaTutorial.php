<?php

namespace App\Models\InformasiTerkini;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelolaTutorial extends Model
{
    protected $table = 'kelola_tutorials';

    /** @use HasFactory<\Database\Factories\KelolaTutorialFactory> */
    use HasFactory;

    protected $fillable = [
        'title',           
        'content',         
        'excerpt',         
        'category',       
        'urgency',         
        'slug',           
        'date',           
        'valid_until',    
        'status',             
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'date' => 'date',
        'valid_until' => 'datetime',
        'last_viewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [];

    // ================================
    // SCOPES
    // ================================

    /**
     * Scope untuk tutorial yang published.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope untuk tutorial yang draft.
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope untuk tutorial yang masih valid (belum expired).
     */
    public function scopeValid(Builder $query): Builder
    {
        return $query->where(function($q) {
            $q->whereNull('valid_until')
              ->orWhere('valid_until', '>=', now());
        });
    }

    /**
     * Scope untuk filter berdasarkan kategori.
     */
    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk filter berdasarkan urgency.
     */
    public function scopeUrgency(Builder $query, string $urgency): Builder
    {
        return $query->where('urgency', $urgency);
    }

    /**
     * Scope untuk tutorial urgent (mendesak/darurat).
     */
    public function scopeUrgent(Builder $query): Builder
    {
        return $query->whereIn('urgency', ['mendesak', 'darurat']);
    }

    /**
     * Scope untuk search functionality.
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function($q) use ($search) {
            $keywords = preg_split('/\s+/', trim($search));
            foreach ($keywords as $word) {
                $q->where(function($q) use ($word) {
                    $q->where('title', 'like', "%{$word}%")
                      ->orWhere('content', 'like', "%{$word}%")
                      ->orWhere('category', 'like', "%{$word}%");
                });
            }
        });
    }

    // ================================
    // ACCESSORS & MUTATORS
    // ================================

    /**
     * Get kategori data untuk display.
     */
    public function getCategoryDataAttribute(): array
    {
        $categories = [
            'maintenance' => [
                'label' => 'Maintenance & Gangguan',
                'icon' => '🔧',
                'color' => 'bg-orange-100 text-orange-800'
            ],
            'layanan' => [
                'label' => 'Layanan IT',
                'icon' => '💡',
                'color' => 'bg-blue-100 text-blue-800'
            ],
            'infrastruktur' => [
                'label' => 'Infrastruktur & Jaringan',
                'icon' => '🌐',
                'color' => 'bg-green-100 text-green-800'
            ],
            'administrasi' => [
                'label' => 'Administrasi PUSTIPD',
                'icon' => '📋',
                'color' => 'bg-purple-100 text-purple-800'
            ],
            'darurat' => [
                'label' => 'Darurat & Penting',
                'icon' => '🚨',
                'color' => 'bg-red-100 text-red-800'
            ]
        ];
        
        return $categories[$this->category] ?? [
            'label' => ucfirst($this->category),
            'icon' => '📄',
            'color' => 'bg-gray-100 text-gray-800'
        ];
    }

    /**
     * Get urgency data untuk display.
     */
    public function getUrgencyDataAttribute(): array
    {
        $urgencies = [
            'normal' => [
                'label' => 'Normal',
                'icon' => '📢',
                'color' => 'bg-gray-100 text-gray-800',
                'priority' => 1
            ],
            'penting' => [
                'label' => 'Penting',
                'icon' => '⚠️',
                'color' => 'bg-yellow-100 text-yellow-800',
                'priority' => 2
            ],
        ];
        
        return $urgencies[$this->urgency] ?? $urgencies['normal'];
    }

    /**
     * Get status color untuk badge display.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'published' => 'bg-green-100 text-green-800',
            'draft' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get formatted date.
     */
    public function getFormattedDateAttribute(): string
    {
        if (!$this->date) {
            return '';
        }
        $date = $this->date instanceof \Carbon\Carbon ? $this->date : \Carbon\Carbon::parse($this->date);
        return $date->format('d M Y');
    }

    /**
     * Get share URLs untuk social media.
     */
    public function getShareUrlsAttribute(): array
    {
        $url = route('pengumuman.show', $this->slug);
        $title = urlencode($this->title);
        $excerpt = urlencode($this->excerpt ?: Str::limit(strip_tags($this->content), 100));
        
        return [
            'whatsapp' => "https://wa.me/?text={$title}%20{$url}",
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'telegram' => "https://t.me/share/url?url={$url}&text={$title}",
            'copy' => $url
        ];
    }

    // ================================
    // METHODS
    // ================================

    /**
     * Check apakah tutorial urgent.
     */
    public function isUrgent(): bool
    {
        return in_array($this->urgency, ['mendesak', 'darurat']);
    }

    /**
     * Check apakah tutorial sudah expired.
     */
    public function isExpired(): bool
    {
        return $this->valid_until && $this->valid_until->isPast();
    }

    /**
     * Check apakah tutorial masih valid.
     */
    public function isValid(): bool
    {
        return !$this->valid_until || $this->valid_until->isFuture();
    }

    /**
     * Check apakah tutorial aktif (published dan valid).
     */
    public function isActive(): bool
    {
        return $this->status === 'published' && $this->isValid();
    }

    /**
     * Increment view count.
     */
    public function incrementView(): void
    {
        $this->increment('view_count');
        $this->update(['last_viewed_at' => now()]);
    }

    /**
     * Generate excerpt dari content jika belum ada.
     */
    public function generateExcerpt(int $length = 150): string
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }
        
        $stripped = strip_tags($this->content);
        return Str::limit($stripped, $length);
    }

    // ================================
    // STATIC METHODS
    // ================================

    /**
     * Get available categories untuk PUSTIPD.
     */
    public static function getCategories(): array
    {
        return [
            'maintenance' => 'Maintenance & Gangguan',
            'layanan' => 'Layanan IT',
            'infrastruktur' => 'Infrastruktur & Jaringan',
            'administrasi' => 'Administrasi PUSTIPD',
            'darurat' => 'Darurat & Penting'
        ];
    }

    /**
     * Get available urgencies.
     */
    public static function getUrgencies(): array
    {
        return [
            'normal' => 'Normal',
            'penting' => 'Penting',
            'mendesak' => 'Mendesak',
            'darurat' => 'Darurat'
        ];
    }

    /**
     * Get available statuses.
     */
    public static function getStatuses(): array
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
        ];
    }

    /**
     * Get tutorial untuk public display.
     */
    public static function getPublicAnnouncements()
    {
        return static::published()
                    ->valid()
                    ->orderByDesc('urgency')
                    ->orderByDesc('date');
    }

    /**
     * Get tutorial urgent untuk alert.
     */
    public static function getUrgentAnnouncements()
    {
        return static::published()
                    ->valid()
                    ->urgent()
                    ->orderByDesc('date')
                    ->take(5);
    }
}

